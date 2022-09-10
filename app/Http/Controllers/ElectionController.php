<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;
use App\ElectionSeatCandidate;
use App\Member;
use App\Seat;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Election::orderBy('id', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function (Election $data) {
                    if ($data->status == 1) {
                        $status = '<div class="form-group">
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch3-' . $data->id . '" onclick="changeStatus(' . $data->id . ',0)" checked>
                                            <label class="custom-control-label" for="customSwitch3-' . $data->id . '"></label>
                                        </div>
                                    </div>';
                    } else {
                        $status = '<div class="form-group">
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch3-' . $data->id . '" onclick="changeStatus(' . $data->id . ',1)">
                                            <label class="custom-control-label" for="customSwitch3-' . $data->id . '"></label>
                                        </div>
                                    </div>';
                    }
                    return $status;
                })
                ->addColumn('action', function (Election $data) {
                    $btn = '<a href="' . route('elections.edit', $data->id) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a>
                            <a href="' . route('elections.assignSeat', $data->id) . '" class="btn btn-primary btn-sm">
                                <i class="fa fa-tasks"></i> Assign Seat
                            </a>';

                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.elections.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.elections.create');
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
            'name' => 'required|string|max:50|unique:elections',
            'start_date' => 'required',
            'end_date' => 'required_if:election_end_checkbox,==,1',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = [
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ];

        Election::create($data);

        return response()->json(['status' => 1, 'message' => 'success']);
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
        $election = Election::findOrFail($id);
        return view('admin.elections.edit', compact('election'));
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
        $election = Election::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:50|unique:elections,name,' . $election->id,
            'start_date' => 'required',
            'end_date' => 'required_if:election_end_checkbox,==,1',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = [
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ];

        $election->update($data);

        return response()->json(['status' => 1, 'message' => 'success']);
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
        $election = Election::findOrFail($request->id);
        if ($election == null) {
            return redirect()->back()->with('error', 'No Record Found');
        }
        $election->update(['status' => $request->input('status')]);
        return response()->json(['status' => '1', 'message' => 'Status Changed Successfully']);
    }

    public function assignSeats(Request $request, $id)
    {
        $election = Election::where('id', $id)->orderBy('id', 'DESC')->first();
        $seats = Seat::orderBy('id', 'DESC')->where('status', 1)->get();

        return view('admin.elections.assign-seat', compact('election', 'seats'));
    }

    public function getMember(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::orderBy('id', 'DESC')->where('mem_status', '!=', 5);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('select', function (Member $data) {
                    $btn = '
                    <a onclick="form(' . $data->id . ')"  href="javascript:void(0)" class="btn btn-sm btn-primary">select</a>
                    ';
                    return $btn;
                })
                ->rawColumns(['select'])
                ->make(true);
        }
        return view('admin.elections.assign-seat');
    }

    public function storeAssignMemberSeat(Request $request)
    {
        $rules = [
            'member_id' => 'required',
            'seat_id' => 'required',
            'election_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = [
            'member_id' => $request->member_id,
            'seat_id' => $request->seat_id,
            'election_id' => $request->election_id,
        ];

        ElectionSeatCandidate::create($data);

        return response()->json(['status' => 1, 'message' => 'success']);
    }

    public function getCandidates(Request $request)
    {
        if ($request->ajax()) {
            $data = ElectionSeatCandidate::orderBy('id', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns(['mem_no'])
                ->make(true);
        }

        return view('admin.elections.assign-seat');
    }
}
