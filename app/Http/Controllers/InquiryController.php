<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class InquiryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::orderBy('id', 'DESC')->where('mem_status',0);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function (Member $data) {
                    $printIT = "";
                    $printIT .=  '<img class="w-25" src="'.asset('storage/app/public/'.$data->image_url).'">';
                    return $printIT;
                })
                ->addColumn('mem_status', function (Member $data) {
                    if ($data->mem_status == 1) {
                        $status = '<span class="badge badge-success">Approved</span>';
                    } else {
                        $status = '<span class="badge badge-danger">Disapproved</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function (Member $data) {
                    $btn = '<a href="' . route('inquires.edit', $data->id) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a>';
                    return $btn;
                })
                ->rawColumns(['action','mem_status','image'])
                ->make(true);
        }

        return view('admin.inquires.index');
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.inquires.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $rules = [
            'mem_no' => 'required|unique:members,mem_no,'. $member->id,
            'name' => 'required|string|max:50',
            'cnic_no' => 'required|unique:members,cnic_no,'. $member->id,
            'birth_date' => 'required',
            'qualification' => 'required',
            'office_address' => 'required',
            'residential_address' => 'required',
            'membership_based_on' => 'required',
            'image_url' => 'nullable|image|mimes:jpeg,jpg,png'
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
            'cnic_no' => $request->input('cnic_no'),
            'birth_date' => $request->input('birth_date'),
            'residential_address' => $request->input('residential_address'),
            'office_address' => $request->input('office_address'),
            'qualification' => $request->input('qualification'),
            'membership_based_on' => $request->input('membership_based_on'),
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
}
