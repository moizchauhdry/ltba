<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Member;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class InquiryController extends Controller
{
    public  function inquiry(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:50',
            'birth_date' => 'required',
            'cnic_no' => 'required|unique:members',
            'qualification' => 'required',
            'membership_based_on' => 'required',
            'office_address' => 'required',
            'residential_address' => 'required',
            'image_url' => 'required|image|mimes:jpeg,jpg,png',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = [
            'name' => $request->input('name'),
            'birth_date' => $request->input('birth_date'),
            'cnic_no' => $request->input('cnic_no'),
            'qualification' => $request->input('qualification'),
            'membership_based_on' => $request->input('membership_based_on'),
            'office_address' => $request->input('office_address'),
            'residential_address' => $request->input('residential_address'),
            'mem_status' => 5,
        ];

        $inquiry = Member::create($data);

        $memberImageDirectory = 'memberImages';
        if ($request->hasFile('image_url')) {
            
            $fileName = $request->file('image_url')->getClientOriginalName();

            if(!Storage::exists($memberImageDirectory)){
                Storage::makeDirectory($memberImageDirectory);
            }
            $imageUrl = Storage::putFile($memberImageDirectory, new File($request->file('image_url')));
            $inquiry->update(['image_url'=> $imageUrl]);
        }

        return response()->json(['status' => 'true', 'data' => $inquiry, 'message' => 'success']);
    }
}
