<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'father_name' => 'required|string|max:50',
            'gender' => 'required',
            'cnic_no' => 'required|unique:members',
            'contact_no' => 'required|unique:members',
            'date_of_birth' => 'required',
            'city' => 'required',
            'address' => 'required',
            'membership_based_on' => 'required',
            'member_ship' => 'required',
            'member_ship_status' => 'required',
            'member_ship_reg_date' => 'required',
            'member_ship_fee_submission' => 'required_if:member_ship_fee_paid,==,1',
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
            'date_of_birth' => $request->input('date_of_birth'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'membership_based_on' => $request->input('membership_based_on'),
            'member_ship' => $request->input('member_ship'),
            'member_ship_status' => $request->input('member_ship_status'),
            'member_ship_reg_date' => $request->input('member_ship_reg_date'),
            'member_ship_fee_submission' => $request->input('member_ship_fee_submission'),
            'remarks' => $request->input('remarks'),
        ];

        $member = Member::create($data);

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
        //
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
        //
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
