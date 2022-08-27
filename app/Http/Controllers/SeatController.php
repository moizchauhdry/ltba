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
                    $status = '<span class="badge badge-success">Active</span>';
                } else {
                    $status = '<span class="badge badge-danger">Inactive</span>';
                }
                return $status;
            })
            ->addColumn('action', function (Seat $data) {
                $btn ='<a href="' . route('seats.edit', $data->id) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a>';
                if ($data->status == 1) {
                    $status = '<a onclick="changeStatus(' . $data->id . ',0)" href="javascript:void(0)" class="btn btn-sm btn-danger mt-1">Deactivate</a>';
                } else {
                    $status = '<a onclick="changeStatus(' . $data->id . ',1)" href="javascript:void(0)" class="btn btn-sm btn-success mt-1">Activate</a>';
                }
                return $btn . " " . $status;
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
}
