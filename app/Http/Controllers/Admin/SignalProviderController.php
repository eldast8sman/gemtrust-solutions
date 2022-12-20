<?php

namespace App\Http\Controllers\Admin;

use App\Mail\Mailings;
use Illuminate\Support\Str;
use App\Models\SignalProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreSignalProviderRequest;
use App\Http\Requests\UpdateSignalProviderRequest;

class SignalProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = SignalProvider::orderBy('name', 'asc');
        if($providers->count() > 0){
            return response([
                'status' => 'success',
                'message' => 'Signal Providers fetched successfully',
                'data' => $providers->get()
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Signal Provider was fetched'
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
     * @param  \App\Http\Requests\StoreSignalProviderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSignalProviderRequest $request)
    {
        $all = $request->all();

        if($provider = SignalProvider::create($all)){
            $token = base64_encode($provider->id."Gemtrust".Str::random(20));
            $provider->verify_token = $token;
            $provider->verify_token_expiry = time() + (60 * 20);
            $provider->status = 0;
            $provider->save();

            Mail::to($provider)->send(new Mailings('Invitiation to be a Signal Provider on Gemtrust', 'emails.add_signal_provider', [
                'title' => 'Invitation to be a Signal Provider',
                'name' => $provider->name,
                'link' => env('APP_URL', 'https://develop.gemtrustsolutions.com').'/signal-provider/activate/'.$token
            ]));

            return response([
                'status' => 'success',
                'message' => 'Signal Provider added successfully',
                'data' => $provider
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Signal Provider was not added'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SignalProvider  $signalProvider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provider = SignalProvider::find($id);
        if(!empty($provider)){
            return response([
                'status' => 'success',
                'message' => 'Signal Provider fetched successfully',
                'data' => $provider
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Signal Provider fetched successfully'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SignalProvider  $signalProvider
     * @return \Illuminate\Http\Response
     */
    public function edit(SignalProvider $signalProvider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSignalProviderRequest  $request
     * @param  \App\Models\SignalProvider  $signalProvider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSignalProviderRequest $request, $id)
    {
        $provider = SignalProvider::find($id);
        if(!empty($provider)){
            $all = $request->all();
            if($provider->update($all)){
                return response([
                    'status' => 'success',
                    'message' => 'Signal Provider Update successful',
                    'data' => $provider
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Signal Provider Update Failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Signal Provider not found'
            ], 404);
        }
        $all = $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SignalProvider  $signalProvider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider = SignalProvider::find($id);
        if(!empty($provider)){
            $provider->delete();

            return response([
                'status' => 'success',
                'message' => 'Signal Provider deleted successfully',
                'data' => $provider
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => "NO Signal Provider was found"
            ], 404);
        }
    }
}
