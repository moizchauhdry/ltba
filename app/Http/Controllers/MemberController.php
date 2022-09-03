<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::orderBy('id', 'DESC')->where('mem_status','!=',5);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function (Member $data) {
                    $printIT = "";
                    $printIT .=  '<img class="w-25" src="'.asset('storage/app/public/'.$data->image_url).'">';
                    return $printIT;
                })
                ->addColumn('mem_status', function (Member $data) {
                    if ($data->mem_status == 1) {
                        $status = '<span class="badge badge-success">Active</span>';
                    } else if($data->mem_status == 2) {
                        $status = '<span class="badge badge-danger">In-active</span>';
                    }else if($data->mem_status == 3) {
                        $status = '<span class="badge badge-danger">Suspended</span>';
                    }else if($data->mem_status == 4) {
                        $status = '<span class="badge badge-primary">Late</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function (Member $data) {
                    $btn = '<a href="' . route('members.edit', $data->id) . '"><i class="fas fa-edit"></i></a>';
                    $dbtn = '<a href="'.route('members.detail', $data->id).'" ><i class="fas fa-eye"></i></a>';
                    return $btn .' '. $dbtn;
                })
                ->rawColumns(['action', 'mem_status','image'])
                ->make(true);
        }

        return view('admin.members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.members.create');
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
            'mem_no' => 'required|unique:members',
            'name' => 'required|string|max:50',
            'image_url' => 'required|image|mimes:jpeg,jpg,png',
            'father_name' => 'required|string|max:50',
            'gender' => 'required',
            'cnic_no' => 'required|unique:members',
            'contact_no' => 'required|unique:members',
            'birth_date' => 'required',
            'city' => 'required',
            'qualification' => 'required',
            'office_address' => 'required',
            'residential_address' => 'required',
            'membership_based_on' => 'required',
            'mem' => 'required',
            'mem_reg_date' => 'required',
            'mem_fee_submission_date' => 'required_if:member_ship_fee_paid,==,1',
            'remarks' => 'required_if:member_ship_fee_paid,==,1',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = [
            'mem_no' => $request->input('mem_no'),
            'name' => $request->input('name'),
            'father_name' => $request->input('father_name'),
            'gender' => $request->input('gender'),
            'cnic_no' => $request->input('cnic_no'),
            'contact_no' => $request->input('contact_no'),
            'birth_date' => $request->input('birth_date'),
            'city' => $request->input('city'),
            'residential_address' => $request->input('residential_address'),
            'office_address' => $request->input('office_address'),
            'qualification' => $request->input('qualification'),
            'membership_based_on' => $request->input('membership_based_on'),
            'mem' => $request->input('mem'),
            'mem_reg_date' => $request->input('mem_reg_date'),
            'mem_status' => 1,
            'mem_fee_submission_date' => $request->input('mem_fee_submission_date'),
            'remarks' => $request->input('remarks'),
        ];

        $member = Member::create($data);

        $memberImageDirectory = 'memberImages';
        if ($request->hasFile('image_url')) {
            
            $fileName = $request->file('image_url')->getClientOriginalName();

            if(!Storage::exists($memberImageDirectory)){
                Storage::makeDirectory($memberImageDirectory);
            }
            $imageUrl = Storage::putFile($memberImageDirectory, new File($request->file('image_url')));
            $member->update(['image_url'=> $imageUrl]);
        }

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
        $member = Member::findOrFail($id);
        return view('admin.members.detail', compact('member')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.edit', compact('member'));
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
        $member = Member::findOrFail($id);
        $rules = [
            'mem_no' => 'required|unique:members,mem_no,'. $member->id,
            'name' => 'required|string|max:50',
            'image_url' => 'nullable|image|mimes:jpeg,jpg,png',
            'father_name' => 'required|string|max:50',
            'gender' => 'required',
            'cnic_no' => 'required|unique:members,cnic_no,'. $member->id,
            'contact_no' => 'required|unique:members,contact_no,'. $member->id,
            'birth_date' => 'required',
            'city' => 'required',
            'qualification' => 'required',
            'office_address' => 'required',
            'residential_address' => 'required',
            'membership_based_on' => 'required',
            'mem' => 'required',
            'mem_reg_date' => 'required',
            'mem_status' => 'required',
            'mem_fee_submission_date' => 'required_if:member_ship_fee_paid,==,1',
            'remarks' => 'required_if:member_ship_fee_paid,==,1',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }
        
        $data = [
            'mem_no' => $request->input('mem_no'),
            'name' => $request->input('name'),
            'father_name' => $request->input('father_name'),
            'gender' => $request->input('gender'),
            'cnic_no' => $request->input('cnic_no'),
            'contact_no' => $request->input('contact_no'),
            'birth_date' => $request->input('birth_date'),
            'city' => $request->input('city'),
            'residential_address' => $request->input('residential_address'),
            'office_address' => $request->input('office_address'),
            'qualification' => $request->input('qualification'),
            'membership_based_on' => $request->input('membership_based_on'),
            'mem' => $request->input('mem'),
            'mem_status' => $request->input('mem_status'),
            'mem_reg_date' => $request->input('mem_reg_date'),
            'mem_fee_submission_date' => $request->input('mem_fee_submission_date'),
            'remarks' => $request->input('remarks'),
        ];

        $memberImageDirectory = 'memberImages';
        if ($request->hasFile('image_url')) {
            
            if(!Storage::exists($memberImageDirectory)){
                Storage::makeDirectory($memberImageDirectory);
            }
            Storage::delete('/'.$member->image_url);
            $imageUrl = Storage::putFile($memberImageDirectory, new File($request->file('image_url')));
            $data['image_url'] = $imageUrl;
        }


        $member->update($data);

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
        $member = Member::findOrFail($request->id);
        if ($member == null) {
            return redirect()->back()->with('error', 'No Record Found');
        }
        $member->update(['mem_status'=> $request->input('mem_status')]);
        return response()->json(['status'=>'1','message'=>'Status Changed Successfully']);
    }
}
