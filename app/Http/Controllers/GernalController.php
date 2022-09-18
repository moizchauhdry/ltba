<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class GernalController extends Controller
{
    public function searchMember(Request $request)
    {

        if($request->search_type_mem_no == 1){
            $member = Member::where('mem_no',$request->search_mem)->first();
            return response()->json(['status' => 1, 'member' => $member]);
        }
        elseif($request->search_type_cnic_no == 2){
            $member = Member::where('cnic_no',$request->search_mem)->first();
            return response()->json(['status' => 1,'member' => $member]);
        }else{
            return response()->json([
                'error' => 'Please Enter Member No OR Cnic No',
            ], 400);
        }
    }

    public function memberView($id)
    {
        $member = Member::find($id);
       

        return view('pages.member',compact('member'));

    }

    public function getMember(Request $request)
    {
        $member = Member::find($request->mem_id);

        return response()->json(['status' => 1,'id' => $member->id]);
    }

    public function updateMember(Request $request, $id)
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
            'mem_status' => 5,
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

    public function thankyou()
    {
        return view('thankyou');
    }

    
    
}
