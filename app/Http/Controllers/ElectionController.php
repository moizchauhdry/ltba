<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;
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
                        $status = '<span class="badge badge-success">Active</span>';
                    } else {
                        $status = '<span class="badge badge-danger">Inactive</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function (Election $data) {
                    $btn = '<a href="' . route('elections.edit', $data->id) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a>';
                    if ($data->status == 1) {
                        $status = '<a onclick="changeStatus(' . $data->id . ',0)" href="javascript:void(0)" class="btn btn-sm btn-danger mt-1">Deactivate</a>';
                    } else {
                        $status = '<a onclick="changeStatus(' . $data->id . ',1)" href="javascript:void(0)" class="btn btn-sm btn-success mt-1">Activate</a>';
                    }
                    return $btn . " " . $status;
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
            'end_date' => 'required_if:election_end_checkbox,==,1'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        Election::create([
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('start_date'),
        ]);

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
        $election = Election::find($id);
        if ($election == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

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
        // dd($request->all());
        $election = Election::find($id);
        if ($election == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

        $rules = [
            'name' => 'required|string|max:50|unique:elections,name,' . $election->id,
            'start_date' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        if ($request->election_end_checkbox == 1) {
            $rules = [
                'end_date' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 400);
            }

            $endDate = $request->input('end_date');
            $checkbox = 1;
        } else {
            $endDate = null;
            $checkbox = 0;
        }

        $electionData = [
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'election_end_checkbox' => $checkbox,
            'end_date' => $endDate,
        ];

        $election->update($electionData);

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
}
