<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Auth;
use Session;
use Hash;
use Validator;
use App\Admin;
use App\Election;
use App\Member;
use App\Seat;



class AdminController extends Controller
{
    public function dashboard()
    {
        return view ('admin.dashboard');
    }

    public function login(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password' => $data['password'],'status' => 1])){
                return redirect()->route('admin.dashboard');
            }
            else{
                Session::flash('error_message','Invalid Email or Password');
                return redirect()->back();
            }
        }
        if(Auth::guard('admin')->check()){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }
    
    public function logout ()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function mangeDashBoard()
    {
        $count = array();
        $count['total_operators'] = Admin::where('status', '=', '1')->count();
        $count['total_elections'] = Election::where('status', '=', '1')->count();
        $count['total_members'] = Member::all()->count();
        $count['total_election_seats'] = Seat::where('status', '=', '1')->count();
       
        return response()->json(['status' => true, 'count' => $count]);
    }

    public function restPassword(Request $request, $id)
    {
        $admin = Admin::where('id',$id)->first();

        return view('admin.reset-password', compact('admin'));
    }

    public function passwordUpdate(Request $request)
    {
        $admin = Admin::find($request->user_id);

        if (Hash::check($request->password,$request->confirm_password)) {
            if ($request->password == $request->confirm_password) {
                Admin::where('id',$admin->id)->update(['password'=>bcrypt($request->password)]);
            }
        }

        return response()->json([ 'status' => 1, 'message' => 'success']);
        
    }

    public function profile()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile',compact('admin'));

    }

    public function profileUpdate(Request $request)
    {
        $admin = Admin::find($request->user_id);
        if ($admin == null) {
            return response()->json([
                'errors' => 'No Record Found.',
            ], 400);
        }

        $rules = [
            'name' => 'required|string|max:50',
            'phone' => 'required',
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
            'phone' => $request->input('phone')
        ];

        $admin->update($data);

        $profileImageDirectory = 'Admin-Users';
        if ($request->image_url) {
            $fileName = $request->file('image_url')->getClientOriginalName();

            if(!Storage::exists($profileImageDirectory)){
                Storage::makeDirectory($profileImageDirectory);
            }
            $imageUrl = Storage::putFile($profileImageDirectory, new File($request->file('image_url')));
            $admin->update(['image_url'=> $imageUrl]);
        }

        return response()->json(['status' => 1, 'message' => 'Your Profile Has Been Update SucessFully!.']);
    }
}
