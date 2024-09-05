<?php

namespace App\Http\Controllers\Frontend;

use App\City;
use App\Member;
use App\Inquiry;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function searchMember(Request $request)
    {
        if ($request->search_member == 1) {
            $member = Member::where('mem_no', $request->search_mem)->first();
        } elseif ($request->search_member == 2) {
            $member = Member::where('cnic_no', $request->search_mem)->first();
        }

        return response()->json(['status' => 1, 'member' => $member]);
    }

    public function memberView($id)
    {
        $member = Member::find($id);
        return view('pages.member', compact('member'));
    }

    public function getMember(Request $request)
    {
        $member = Member::find($request->mem_id);
        return response()->json(['status' => 1, 'id' => $member->id]);
    }

    public function updateMember(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $rules = [
            'mem_no' => 'required|unique:members,mem_no,' . $member->id,
            'name' => 'required|string|max:50',
            'image_url' => 'nullable|image|mimes:jpeg,jpg,png',
            'father_name' => 'required|string|max:50',
            'gender' => 'required',
            'cnic_no' => 'required|unique:members,cnic_no,' . $member->id,
            'contact_no' => 'required|unique:members,contact_no,' . $member->id,
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

            if (!Storage::exists($memberImageDirectory)) {
                Storage::makeDirectory($memberImageDirectory);
            }
            Storage::delete('/' . $member->image_url);
            $imageUrl = Storage::putFile($memberImageDirectory, new File($request->file('image_url')));
            $data['image_url'] = $imageUrl;
        }


        // $member->update($data);
        Inquiry::updateOrCreate(['mem_no' => $member->mem_no], $data);

        return response()->json(['status' => 1, 'message' => 'success']);
    }

    public function thankyou()
    {
        return view('thankyou');
    }

    public function create()
    {
        Session::forget('member_webcam_image');
        $cities = City::orderBy('name', 'asc')->get();

        return view('frontend.members.create', compact('cities'));
    }

    public function store(Request $request)
    {

        $webcam_image_url = $request->session()->get('member_webcam_image');

        $rules = [

            'name'                        => 'required|string|max:50',
            'email'                       => 'required',
            'image_url'                   => 'nullable',
            'father_name'                 => 'required|string|max:50',
            'gender'                      => 'required',
            'cnic_no'                     => 'required|unique:members',
            'contact_no'                  => 'required|unique:members',
            'birth_date'                  => 'required',
            'city'                        => 'required',
            'qualification'               => 'required',
            'office_address'              => 'required',
            'residential_address'         => 'required',
            'pbc_license_image_front_url' => 'required|image|mimes:jpeg,jpg,png',
            'pbc_license_image_back_url'  => 'required|image|mimes:jpeg,jpg,png',
            'cnic_image_front_url'        => 'required|image|mimes:jpeg,jpg,png',
            'cnic_image_back_url'         => 'required|image|mimes:jpeg,jpg,png',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = [

            'name'                => $request->input('name'),
            'email'               => $request->input('email'),
            'father_name'         => $request->input('father_name'),
            'gender'              => $request->input('gender'),
            'cnic_no'             => $request->input('cnic_no'),
            'contact_no'          => $request->input('contact_no'),
            'birth_date'          => $request->input('birth_date'),
            'city'                => $request->input('city'),
            'residential_address' => $request->input('residential_address'),
            'office_address'      => $request->input('office_address'),
            'qualification'       => $request->input('qualification'),
            'mem_status'          => 1,
        ];

        $member = Member::create($data);

        $memberImageDirectory = 'memberImages';
        if ($request->hasFile('image_url')) {

            $fileName = $request->file('image_url')->getClientOriginalName();

            if (!Storage::exists($memberImageDirectory)) {
                Storage::makeDirectory($memberImageDirectory);
            }
            $imageUrl = Storage::putFile($memberImageDirectory, new File($request->file('image_url')));
            $member->update(['image_url' => $imageUrl]);
        }

        $memberLicenseImageDirectory = 'memberLicenseImages';
        if ($request->hasFile('pbc_license_image_front_url')) {

            $fileName = $request->file('pbc_license_image_front_url')->getClientOriginalName();

            if (!Storage::exists($memberLicenseImageDirectory)) {
                Storage::makeDirectory($memberLicenseImageDirectory);
            }
            $imageUrl = Storage::putFile($memberLicenseImageDirectory, new File($request->file('pbc_license_image_front_url')));
            $member->update(['license_front' => $imageUrl]);
        }
        if ($request->hasFile('pbc_license_image_back_url')) {

            $fileName = $request->file('pbc_license_image_back_url')->getClientOriginalName();

            if (!Storage::exists($memberLicenseImageDirectory)) {
                Storage::makeDirectory($memberLicenseImageDirectory);
            }
            $imageUrl = Storage::putFile($memberLicenseImageDirectory, new File($request->file('pbc_license_image_back_url')));
            $member->update(['license_back' => $imageUrl]);
        }


        $memberCNICImageDirectory = 'memberCNICImages';
        if ($request->hasFile('cnic_image_front_url')) {

            $fileName = $request->file('cnic_image_front_url')->getClientOriginalName();

            if (!Storage::exists($memberCNICImageDirectory)) {
                Storage::makeDirectory($memberCNICImageDirectory);
            }
            $imageUrl = Storage::putFile($memberCNICImageDirectory, new File($request->file('cnic_image_front_url')));
            $member->update(['cnic_front' => $imageUrl]);
        }
        if ($request->hasFile('cnic_image_back_url')) {

            $fileName = $request->file('cnic_image_back_url')->getClientOriginalName();

            if (!Storage::exists($memberCNICImageDirectory)) {
                Storage::makeDirectory($memberCNICImageDirectory);
            }
            $imageUrl = Storage::putFile($memberCNICImageDirectory, new File($request->file('cnic_image_back_url')));
            $member->update(['cnic_back' => $imageUrl]);
        }

        if ($webcam_image_url != NULL) {
            $member->update(['image_url' => $webcam_image_url]);
        }

        return response()->json(['status' => 1, 'message' => 'success']);
    }
}
