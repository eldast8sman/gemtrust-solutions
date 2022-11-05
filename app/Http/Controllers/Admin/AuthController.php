<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdatePasswordRequest;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        if(!empty($admins)){
            return response([
                'status' => 'success',
                'message' => 'Admins fetched successfully',
                'data' => $admins
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Admin was fetched'
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        $all = $request->all();
        if(isset($all['password']) && !empty($all['password'])){
            $all['password'] = Hash::make($all['passwprd']);
        }

        if($admin = Admin::create($all)){
            return response([
                'status' => 'success',
                'message' => 'Admin created succesfuly',
                'data' => $admin
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Admin Creation failed'
            ], 500);
        }
    }

    public function login(AdminLoginRequest $request){
        $all = $request->all();

        if($token = auth('admin-api')->attempt($all)){
            $admin = Admin::where('email', $all['email'])->first();
            $admin->authorization = [
                'token' => $token,
                'type' => 'Bearer',
                'expiry' => auth('admin-api')->factory()->getTTL() * 60
            ];

            return response([
                'status' => 'success',
                'message' => 'Login was successful',
                'data' => $admin
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Admin Login failed due to wrong Credentials'
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        if(!empty($admin)){
            return response([
                'status' => 'success',
                'message' => 'Admin Found Successfully',
                'data' => $admin
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Admin Not Found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        if(!empty($admin)){
            $all = $request->all();
            if($admin->update($all)){
                return response([
                    'status' => 'success',
                    'message' => 'Admin Updated successfully',
                    'data' => $admin
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Admin Update failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Admin was not found'
            ], 404);
        }
    }

    public function changePassword(UpdatePasswordRequest $request){
        $old_password = $request->current_password;

        $credentials = [
            'email' => auth('admin-api')->user()->email,
            'password' => $old_password
        ];

        if(auth('admin-api')->attempt($credentials)){
            $admin = Admin::find(auth('admin-api')->user()->id);
            $admin->password = Hash::make($request->password);
            $admin->save();

            $new_credentials = [
                'email' => $admin->email,
                'password' => $request->password
            ];

            if($token = auth('admin-api')->attempt($new_credentials)){
                $admin->authorization = [
                    'token' => $token,
                    'type' => 'Bearer',
                    'expiry' => auth('admin-api')->factory()->getTTL() * 60
                ];

                return response([
                    'status' => 'success',
                    'message' => 'Admin Password changed successfully'
                ]);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'User Login Failed due to wrong credentials',
                    'data' => $admin
                ], 401);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Wrong Password was provided'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        if(!empty($admin)){
            if($admin->delete()){
                return response([
                    'status' => 'success',
                    'message' => 'Admin Deleted Successfully',
                    'data' => $admin
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Admin Delete Failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Admin was fetched'
            ], 404);
        }
    }

    public function logout(){
        auth('admin-api')->logout();

        return response([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ], 200);
    }
}
