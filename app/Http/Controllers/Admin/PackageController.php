<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Package;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::orderBy('reg_amount', 'asc');
        if($packages->count() > 0){
            return response([
                'status' => 'success',
                'message' => 'Packages fetched successfully',
                'data' => $packages
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Package was fetched'
            ]);
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
     * @param  \App\Http\Requests\StorePackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageRequest $request)
    {
        $all = $request->all();
        if($all['reg_amount'] > ($all['upline1'] + $all['upline2'] + $all['upline3'] + $all['upline4'])){
            if($package = Package::create($all)){
                return response([
                    'status' => 'success',
                    'message' => 'Package added successfully',
                    'data' => $package
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Could not add Package'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Upline Compensations must be less than the registration amount'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::find($id);
        if(!empty($package)){
            return response([
                'status' => 'success',
                'message' => 'Package fetched successfully',
                'data' => $package
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Package was fetched'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageRequest  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageRequest $request, $id)
    {
        $package = Package::find($id);
        if(!empty($package)){
            $all = $request->all();
            if($all['reg_amount'] > ($all['upline1'] + $all['upline2'] + $all['upline3'] + $all['upline4'])){
                if($package->update($all)){
                    return response([
                        'status' => 'success',
                        'message' => 'Package Updated successfully',
                        'data' => $package
                    ], 200);
                } else {
                    return response([
                        'status' => 'failed',
                        'message' => 'Package Update Failed'
                    ], 500);
                }
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Upline Compensations must be less than the registration amount'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Package was fetched'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::find($id);
        if(!empty($package)){
            if($package->delete()){
                return response([
                    'status' => 'success',
                    'message' => 'Package was successfully deleted',
                    'data' => $package
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Could not delete Package'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Package was fetched'
            ], 404);
        }
    }
}
