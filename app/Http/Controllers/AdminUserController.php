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
            $data = Admin::where('id', '!=', $user->id)->where('id', '!=', '1')->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('permissions', function (Admin $data) {
                    $permissions = $data->permissions()->get();
                    $printIT = "";
                    foreach ($permissions as $permission) {
                        $printIT .= '<span class="badge badge-success">' . $permission->name . '</span>';
                    }
                    return $printIT;
                })
                ->addColumn('status', function (Admin $data) {

                    if ($data->status == 1) {
                        $status = '<div class="form-group">
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch3" onclick="changeStatus(' . $data->id . ',0)" checked>
                                            <label class="custom-control-label" for="customSwitch3"></label>
                                        </div>
                                    </div>';
                    } else {
                        $status = '<div class="form-group">
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch3" onclick="changeStatus(' . $data->id . ',1)">
                                            <label class="custom-control-label" for="customSwitch3"></label>
                                        </div>
                                    </div>';
                    }
                    return $status;
                })
                ->addColumn('action', function (Admin $data) {
                    $btn = '<a href="' . route('admins.edit', $data->id) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit </a>
                            <a onclick="deleteUser(' . $data->id . ')" href="javascript:void(0)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</a>
                            <a href="' . route('admins.reset-password', $data->id) . '" class="btn btn-default btn-sm">
                                Reset Password
                            </a>';
                    
                    
                    return $btn;
                })
                ->rawColumns(['action', 'permissions', 'status'])
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
        return view('admin.adminusers.create', compact('permissions'));
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
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:admins',
            'phone' => 'required',
            'password' => 'required|string|min:6|confirmed|max:32',
            'permissions' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

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

        return response()->json([ 'status' => 1, 'message' => 'success']);
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
        return view('admin.adminusers.edit', compact('admin', 'permissions'));
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
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'required',
            'permissions' => 'required|array'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        if (!empty($request->password) || !empty($request->password_confirmation)) {
            $rules['password'] = 'required|string|min:6|max:32|confirmed';
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

        return response()->json([ 'status' => 1, 'message' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Request $request)
    {
        try {
            $admin = Admin::findOrFail((int)$request->id);
            if ($admin == null) {
                return redirect()->back()->with('error', 'No Record Found To Delete.');
            }

            $admin->permissions()->detach();
            $admin->delete();
            return response()->json(['status' => 1, 'message' => 'Record deleted successfully.']);

        } catch (\Throwable $th) {
            return response()->json(['error' => 1, 'message' => 'The record could not be deleted.']);
        }
    }

    public function status(Request $request)
    {
        $admin = Admin::findOrFail($request->id);
        if ($admin == null) {
            return redirect()->back()->with('error', 'No Record Found');
        }
        $admin->update(['status'=> $request->input('status')]);
        return response()->json(['status'=>'1','message'=>'Status Changed Successfully']);
    }
}
