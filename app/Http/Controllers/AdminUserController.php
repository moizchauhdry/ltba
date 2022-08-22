<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Validator;
use App\Admin;
use App\Permission;
use Yajra\DataTables\DataTables;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::guard('admin')->user();
        if ($request->ajax()) {
            $data = Admin::where('id','!=',$user->id)->where('id','!=','1')->orderBy('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('permissions', function(Admin $data) {
                    $permissions = $data->permissions()->get();
                    $printIT = "";
                    foreach ($permissions as $permission)
                    {
                        $printIT .= '<span class="badge badge-success">'.$permission->name.'</span>';
                    }
                    return $printIT;
                })
                ->addColumn('status', function(Admin $data){

                    if($data->status == 1){
                        $status = '<span class="badge badge-success">Active</span>';
                    }
                    else{
                        $status = '<span class="badge badge-danger">Inactive</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function(Admin $data){

                    $btn = '<a href="'.route('admins.edit', $data->id).'" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a>
                            <a onclick="deleteUser('.$data->id.')" href="javascript:void(0)" class="btn btn-sm btn-danger">Delete</a>';
                    if($data->status == 1){
                        $status = '<a onclick="changeStatus('.$data->id.',0)" href="javascript:void(0)" class="btn btn-sm btn-danger mt-1">Deactivate</a>';
                    }
                    else{
                        $status = '<a onclick="changeStatus('.$data->id.',1)" href="javascript:void(0)" class="btn btn-sm btn-success mt-1">Activate</a>';
                    }
                    return $btn." ".$status;
                })
                ->rawColumns(['action','permissions','status'])
                ->make(true);
        }
        return view('admin.adminusers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view ('admin.adminusers.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:admins',
            'phone' => 'required|numeric|digits_between:10,15',
            'password' => 'required|string|min:6|confirmed|max:32',
            'permissions' => 'required',
        ]);

        $adminUserData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
        ];

        $adminUser = Admin::create($adminUserData);
        
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $adminUser->permissions()->attach($permissions);
        }

        return redirect()->route('admins.index')->with('success', 'Record Added Successfully.');
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
        $admin = Admin::find($id);
        if ($admin == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }
        $permissions = Permission::all();
        return view('admin.adminusers.edit',compact('admin','permissions'));
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
        $admin = Admin::find($id);
        if ($admin == null) {
            return redirect()->back()->with('error', 'No Record Found.');
        }

        $rules = [
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:admins,email,'.$admin->id,
            'phone' => 'required',
            'permissions' => 'required|array'
        ];

        if (!empty($request->password) || !empty($request->password_confirmation)) {
            $rules['password'] = 'required|string|min:6|max:32|confirmed';
        }
       
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $userData = [
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'status' => $request->input('status'),
        ];

        if (!empty($request->password)) {
            $userData['password'] = Hash::make($request->password);
        }

        if ($request->has('permissions')) {
            $admin->permissions()->detach();
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $admin->permissions()->attach($permissions);
        }
        $admin->update($userData);

        return redirect()->route('admins.index')->with('success', 'Record Updated Successfully.');
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
