<?php

namespace App\Http\Controllers;

use App\Inquiry;
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
            $data = Inquiry::orderBy('id', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    $printIT = "";
                    $printIT .=  '<img class="custom-image-preview" src="' . asset('storage/app/public/' . $data->image_url) . '">';
                    return $printIT;
                })
                ->addColumn('mem_status', function ($data) {
                    if ($data->mem_status == 1) {
                        $status = '<span class="badge badge-success">Active</span>';
                    } else if ($data->mem_status == 2) {
                        $status = '<span class="badge badge-danger">In-active</span>';
                    } else if ($data->mem_status == 3) {
                        $status = '<span class="badge badge-danger">Suspended</span>';
                    } else if ($data->mem_status == 4) {
                        $status = '<span class="badge badge-warning">Late</span>';
                    } else {
                        $status = '<span class="badge badge-primary">Pending</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="' . route('inquires.edit', $data->id) . '"><i class="fas fa-edit"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'mem_status', 'image'])
                ->make(true);
        }

        return view('admin.inquires.index');
    }

    public function edit($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        return view('admin.inquires.edit', compact('inquiry'));
    }

    public function update(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $rules = [
            'mem_no' => 'required|unique:inquiries,mem_no,' . $inquiry->id,
            'name' => 'required|string|max:50',
            'cnic_no' => 'required|unique:inquiries,cnic_no,' . $inquiry->id,
            'birth_date' => 'required',
            'qualification' => 'required',
            'office_address' => 'required',
            'residential_address' => 'required',
            'membership_based_on' => 'required',
            'mem_status' => 'required',
            'image_url' => 'nullable|image|mimes:jpeg,jpg,png',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = [
            'name' => $request->input('name'),
            'cnic_no' => $request->input('cnic_no'),
            'birth_date' => $request->input('birth_date'),
            'residential_address' => $request->input('residential_address'),
            'office_address' => $request->input('office_address'),
            'qualification' => $request->input('qualification'),
            'membership_based_on' => $request->input('membership_based_on'),
            'mem_status' => $request->input('mem_status'),
        ];

        $inquiryImageDirectory = 'memberImages';
        if ($request->hasFile('image_url')) {

            if (!Storage::exists($inquiryImageDirectory)) {
                Storage::makeDirectory($inquiryImageDirectory);
            }
            Storage::delete('/' . $inquiry->image_url);
            $imageUrl = Storage::putFile($inquiryImageDirectory, new File($request->file('image_url')));
            $data['image_url'] = $imageUrl;
        }

        $inquiry->update($data);

        if ($inquiry->mem_status == 1) {
            $member = Member::find($inquiry->id);
            $member->update($data);
        }

        return response()->json(['status' => 1, 'message' => 'success']);
    }
}
