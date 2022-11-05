<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function fetch_admins(){
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
    public function store()
    {
        //
    }

    public function storeAdmin(StoreAdminRequest $request){
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
