<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Seat;
use Yajra\DataTables\DataTables;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Seat::orderBy('id','DESC');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function (Seat $data) {
                if ($data->status == 1) {
                    $status = '<div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch3" onclick="changeStatus(' . $data->id . ',0)" checked>
                                        <label class="custom-control-label" for="customSwitch3"></label>
                                    </div>
                                </div>';
                } else {
                    $status = '<div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch3" onclick="changeStatus(' . $data->id . ',1)">
                                        <label class="custom-control-label" for="customSwitch3"></label>
                                    </div>
                                </div>';
                }
                
                return $status;
            })
            ->addColumn('action', function (Seat $data) {
                $btn ='<a href="' . route('seats.edit', $data->id) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a>';
                return $btn;
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }

        return view('admin.seats.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.seats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:50|unique:seats',
            'status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = [
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ];

        $seat = Seat::create($data);

        return response()->json([ 'status' => 1, 'message' => 'success']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seat = Seat::find($id);
        if ($seat == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        
        return view('admin.seats.edit', compact('seat'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $seat = Seat::find($id);

        if ($seat == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

        $rules = [
            'name' => 'required|string|max:50|unique:seats,name,' . $seat->id,
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = [
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ];

        $seat->update($data);

        return response()->json([ 'status' => 1, 'message' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function status(Request $request)
    {
        $seat = Seat::findOrFail($request->id);
        if ($seat == null) {
            return redirect()->back()->with('error', 'No Record Found');
        }
        $seat->update(['status'=> $request->input('status')]);
        return response()->json(['status'=>'1','message'=>'Status Changed Successfully']);
    }
}
