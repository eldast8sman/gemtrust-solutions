<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use App\Models\Partner;
use App\Models\PackagePartner;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Http\Requests\PackagePartnerRequest;

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
                'data' => $packages->get()
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
            $partners = [];
            $packPartners = PackagePartner::where('package_id', $package->id);
            if($packPartners->count() > 0){
                foreach($packPartners->get() as $pack){
                    $partner = Partner::find($pack->partner_id);
                    $partners[] = [
                        'id' => $pack->id,
                        'partner' => $partner->partner,
                        'amount' => $pack->amount
                    ];
                }
            }
            $package->partners = $partners;
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

    public function addPartner(PackagePartnerRequest $request){
        $pack_partner = PackagePartner::where('package_id', $request->package_id)->where('partner_id', $request->partner_id);
        if($pack_partner->count() > 0){
            $partner = $pack_partner->first();
            $partner->update($request->all());
        } else {
            $partner = PackagePartner::create($request->all());
        }

        return response([
            'status' => 'success',
            'message' => 'Partner added to Package',
            'data' => $partner
        ], 200);
    }

    public function removePartner($id){
        $package_partner = PackagePartner::find($id);
        if(!empty($package_partner)){
            $package_partner->delete();
            return response([
                'status' => 'success',
                'message' => 'Partner successfully deleted',
                'data' => $package_partner
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Partner was fetched',
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
                $partners = PackagePartner::where('package_id', $package->id);
                if($partners->count() > 0){
                    foreach($partners->get() as $partner){
                        $partner->delete();
                    }
                }
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
