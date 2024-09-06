<?php

namespace App\Http\Controllers;

use App\Biometric;
use App\City;
use Illuminate\Http\Request;
use App\Member;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use PDF;
use App\Imports\MemberImport;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::orderBy('id', 'DESC')->where('mem_status', 1);
            return Datatables::of($data)
                ->addColumn('image', function (Member $data) {
                    if ($data->image_url) {
                        $res =  '<img class="custom-image-preview" src="' . asset('storage/app/public/' . $data->image_url) . '">';
                    } else {
                        $res =  '<img class="custom-image-preview" src="' . asset('public/images/dummy-image.png') . '">';
                    }

                    return $res;
                })
                ->addColumn('mem_status', function (Member $data) {
                    return getMemberStatus($data);
                })
                ->addColumn('action', function (Member $data) {
                    $btn = '<a class="btn btn-warning btn-xs" href="' . route('members.edit', $data->id) . '"><i class="fas fa-edit"></i> Edit</a>';
                    $dbtn = '<a class="btn btn-info btn-xs"  href="' . route('members.detail', $data->id) . '" ><i class="fas fa-file"></i> Detail</a>';
                    $dbtn1 = '<a class="btn btn-primary btn-xs"  href="' . route('members.generatePDF', $data->id) . '" ><i class="fas fa-file-pdf"></i> Print</a>';
                    return $btn . ' ' . $dbtn . ' ' . $dbtn1;
                })
                ->rawColumns(['action', 'mem_status', 'image', 'bio_status'])
                ->make(true);
        }

        return view('admin.members.index');
    }

    public function create()
    {
        Session::forget('member_webcam_image');
        $cities = City::orderBy('name', 'asc')->get();

        return view('admin.members.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $webcam_image_url = $request->session()->get('member_webcam_image');

        $rules = [
            'mem_no' => 'required|unique:members',
            'name' => 'nullable|string|max:50',
            'email' => 'nullable',
            'image_url' => 'nullable',
            'father_name' => 'nullable|string|max:50',
            'gender' => 'nullable',
            'cnic_no' => 'nullable|unique:members',
            'contact_no' => 'nullable|unique:members',
            'birth_date' => 'nullable',
            'city' => 'nullable',
            'qualification' => 'nullable',
            'office_address' => 'nullable',
            'residential_address' => 'nullable',
            'membership_based_on' => 'nullable',
            'mem' => 'nullable',
            'mem_reg_date' => 'nullable',
            'mem_fee_submission_date' => 'required_if:member_ship_fee_paid,==,1',
            'remarks' => 'required_if:member_ship_fee_paid,==,1',
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
            'mem_no' => $request->input('mem_no'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
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

            if (!Storage::exists($memberImageDirectory)) {
                Storage::makeDirectory($memberImageDirectory);
            }
            $imageUrl = Storage::putFile($memberImageDirectory, new File($request->file('image_url')));
            $member->update(['image_url' => $imageUrl]);
        }

        $memberCertificateImageDirectory = 'memberCertificateImages';
        if ($request->hasFile('certificate_image_url')) {

            $fileName = $request->file('certificate_image_url')->getClientOriginalName();

            if (!Storage::exists($memberCertificateImageDirectory)) {
                Storage::makeDirectory($memberCertificateImageDirectory);
            }
            $imageUrl = Storage::putFile($memberCertificateImageDirectory, new File($request->file('certificate_image_url')));
            $member->update(['certificate_image_url' => $imageUrl]);
        }


        $memberPaymentVoucherImageDirectory = 'memberPaymentVoucherImages';
        if ($request->hasFile('payment_voucher_image_url')) {

            $fileName = $request->file('payment_voucher_image_url')->getClientOriginalName();

            if (!Storage::exists($memberPaymentVoucherImageDirectory)) {
                Storage::makeDirectory($memberPaymentVoucherImageDirectory);
            }
            $imageUrl = Storage::putFile($memberPaymentVoucherImageDirectory, new File($request->file('payment_voucher_image_url')));
            $member->update(['payment_voucher_image_url' => $imageUrl]);
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

    public function show($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.members.detail', compact('member'));
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        Session::forget('member_webcam_image');
        $cities = City::orderBy('name', 'asc')->get();

        return view('admin.members.edit', compact('member', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $webcam_image_url = $request->session()->get('member_webcam_image');

        $rules = [
            'name' => 'nullable|string|max:50',
            'email' => 'nullable|email|string|max:50',
            'image_url' => 'nullable|image|mimes:jpeg,jpg,png',
            'father_name' => 'nullable|string|max:50',
            'gender' => 'nullable',
            'cnic_no' => 'nullable|unique:members,cnic_no,' . $member->id,
            'contact_no' => 'nullable|unique:members,contact_no,' . $member->id,
            'birth_date' => 'nullable',
            'city' => 'nullable',
            'qualification' => 'nullable',
            'office_address' => 'nullable',
            'residential_address' => 'nullable',
            'membership_based_on' => 'nullable',
            'mem' => 'nullable',
            'mem_reg_date' => 'nullable',
            'mem_status' => 'nullable',
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
            'name' => $request->input('name'),
            'email' => $request->input('email'),
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

            if (!Storage::exists($memberImageDirectory)) {
                Storage::makeDirectory($memberImageDirectory);
            }
            Storage::delete('/' . $member->image_url);
            $imageUrl = Storage::putFile($memberImageDirectory, new File($request->file('image_url')));
            $data['image_url'] = $imageUrl;
        }

        $memberCertificateImageDirectory = 'memberCertificateImages';
        if ($request->hasFile('certificate_image_url')) {

            if (!Storage::exists($memberCertificateImageDirectory)) {
                Storage::makeDirectory($memberCertificateImageDirectory);
            }
            Storage::delete('/' . $member->certificate_image_url);
            $imageUrl = Storage::putFile($memberCertificateImageDirectory, new File($request->file('certificate_image_url')));
            $data['certificate_image_url'] = $imageUrl;
        }


        $memberPaymentVoucherImageDirectory = 'memberPaymentVoucherImages';
        if ($request->hasFile('payment_voucher_image_url')) {

            if (!Storage::exists($memberPaymentVoucherImageDirectory)) {
                Storage::makeDirectory($memberPaymentVoucherImageDirectory);
            }
            Storage::delete('/' . $member->payment_voucher_image_url);
            $imageUrl = Storage::putFile($memberPaymentVoucherImageDirectory, new File($request->file('payment_voucher_image_url')));
            $data['payment_voucher_image_url'] = $imageUrl;
        }


        $memberLicenseImageDirectory = 'memberLicenseImages';
        if ($request->hasFile('pbc_license_image_front_url')) {

            if (!Storage::exists($memberLicenseImageDirectory)) {
                Storage::makeDirectory($memberLicenseImageDirectory);
            }
            Storage::delete('/' . $member->license_front);
            $imageUrl = Storage::putFile($memberLicenseImageDirectory, new File($request->file('pbc_license_image_front_url')));
            $data['license_front'] = $imageUrl;
        }
        if ($request->hasFile('pbc_license_image_back_url')) {

            if (!Storage::exists($memberLicenseImageDirectory)) {
                Storage::makeDirectory($memberLicenseImageDirectory);
            }
            Storage::delete('/' . $member->license_back);
            $imageUrl = Storage::putFile($memberLicenseImageDirectory, new File($request->file('pbc_license_image_back_url')));
            $data['license_back'] = $imageUrl;
        }


        $memberCNICImageDirectory = 'memberCNICImages';
        if ($request->hasFile('cnic_image_front_url')) {

            if (!Storage::exists($memberCNICImageDirectory)) {
                Storage::makeDirectory($memberCNICImageDirectory);
            }
            Storage::delete('/' . $member->cnic_front);
            $imageUrl = Storage::putFile($memberCNICImageDirectory, new File($request->file('cnic_image_front_url')));
            $data['cnic_front'] = $imageUrl;
        }
        if ($request->hasFile('cnic_image_back_url')) {

            if (!Storage::exists($memberCNICImageDirectory)) {
                Storage::makeDirectory($memberCNICImageDirectory);
            }
            Storage::delete('/' . $member->cnic_back);
            $imageUrl = Storage::putFile($memberCNICImageDirectory, new File($request->file('cnic_image_back_url')));
            $data['cnic_back'] = $imageUrl;
        }

        $member->update($data);

        if ($webcam_image_url != NULL) {
            $member->update(['image_url' => $webcam_image_url]);
        }

        return response()->json(['status' => 1, 'message' => 'success']);
    }

    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        return redirect()->route('members.index');
    }

    public function status(Request $request)
    {
        $member = Member::findOrFail($request->id);
        if ($member == null) {
            return redirect()->back()->with('error', 'No Record Found');
        }
        $member->update(['mem_status' => $request->input('mem_status')]);
        return response()->json(['status' => '1', 'message' => 'Status Changed Successfully']);
    }

    public function paymentUpdate(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $rules = [
            'mem_fee_submission_date' => 'required',
            'remarks' => 'required',
            'certificate_image_url' => 'nullable|image|mimes:jpeg,jpg,png',
            'payment_voucher_image_url' => 'nullable|image|mimes:jpeg,jpg,png',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $data = [
            'mem_fee_submission_date' => $request->input('mem_fee_submission_date'),
            'remarks' => $request->input('remarks'),
        ];

        $memberCertificateImageDirectory = 'memberCertificateImages';
        if ($request->hasFile('certificate_image_url')) {

            if (!Storage::exists($memberCertificateImageDirectory)) {
                Storage::makeDirectory($memberCertificateImageDirectory);
            }
            Storage::delete('/' . $member->certificate_image_url);
            $imageUrl = Storage::putFile($memberCertificateImageDirectory, new File($request->file('certificate_image_url')));
            $data['certificate_image_url'] = $imageUrl;
        }


        $memberPaymentVoucherImageDirectory = 'memberPaymentVoucherImages';
        if ($request->hasFile('payment_voucher_image_url')) {

            if (!Storage::exists($memberPaymentVoucherImageDirectory)) {
                Storage::makeDirectory($memberPaymentVoucherImageDirectory);
            }
            Storage::delete('/' . $member->payment_voucher_image_url);
            $imageUrl = Storage::putFile($memberPaymentVoucherImageDirectory, new File($request->file('payment_voucher_image_url')));
            $data['payment_voucher_image_url'] = $imageUrl;
        }


        $member->update($data);

        return response()->json(['status' => 1, 'message' => 'success']);
    }

    public function generatePDF($id)
    {
        $member = Member::findOrFail($id);
        $pdf = PDF::loadView('admin.members.pdf', compact(['member']));

        return $pdf->stream('Application-' . $member->id . '.pdf');
    }

    public function importData(Request $request)
    {
        try {
            Excel::import(new MemberImport, $request->file);
            return response()->json(['status' => 1, 'message' => 'The record have been import successfully.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 1, 'message' => 'Operation failed to perform. Please try again later.'], 400);
        }
    }

    public function uploadWebcamImage(Request $request)
    {
        // dd($request->all());
        $img = $request->image;
        $folderPath = "MemberWebcamImages/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);

        // dd('Image uploaded successfully: ' . $fileName);

        $url = $folderPath . '/' . $fileName;
        $request->session()->forget('member_webcam_image');
        $request->session()->put('member_webcam_image', $url);
        // $value = $request->session()->get('member_webcam_image');

        return response()->json(['status' => 1, 'message' => 'success']);
    }
}
