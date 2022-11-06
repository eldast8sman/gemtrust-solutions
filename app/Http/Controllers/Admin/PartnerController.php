<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\Partner;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Models\Wallet;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::orderBy('partner')->get();
        if(!empty($partners)){
            return response([
                'status' => 'success',
                'message' => 'Partners fetched successfully',
                'data' => $partners
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Partner was fetched'
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
     * @param  \App\Http\Requests\StorePartnerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnerRequest $request)
    {
        $all = $request->all();
        $bank = Bank::fetch_bankName($all['bank'])->first();
        $all['bank_code'] = $bank->code;
        $all['bank_nip'] = $bank->nip;
        if($partner = Partner::create($all)){
            Wallet::create([
                'type' => 'partner',
                'user_id' => $partner->id
            ]);
            return response([
                'status' => 'success',
                'message' => 'Partner Created successfully',
                'data' => $partner
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Partner creation failed',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partner = Partner::find($id);
        if(!empty($partner)){
            return response([
                'status' => 'success',
                'message' => 'Partner was fetched successfully',
                'data' => $partner
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Partner was fetched'
            ], 404);
        }
    }

    public function fetchWallet($id){
        $wallet = Wallet::where('type', 'partner')->where('user_id', $id)->first();
        if(!empty($wallet)){
            return response([
                'status' => 'success',
                'message' => 'Wallet Found',
                'data' => $wallet
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Wallet was found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePartnerRequest  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartnerRequest $request, $id)
    {
        $partner = Partner::find($id);
        if(!empty($partner)){
            $all = $request->all();
            if(!empty($all['bank'])){
                $bank = Bank::fetch_bankName($all['bank'])->first();
                $all['bank_code'] = $bank->code;
                $all['bank_nip'] = $bank->nip;
            }

            if($partner->update($all)){
                return response([
                    'status' => 'success',
                    'message' => 'Partner updated successfully',
                    'data' => $partner
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Partner was not Updated'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Partner was fetched'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::find($id);
        if(!empty($partner)){
            $partner->delete();
            return response([
                'status' => 'success',
                'message' => 'Partner deleted successfully',
                'data' => $partner
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Partner was fetched'
            ], 400);
        }
    }
}
