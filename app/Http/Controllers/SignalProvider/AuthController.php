<?php

namespace App\Http\Controllers\SignalProvider;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SignalProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SignalProvider\AccountActivationRequest;
use App\Http\Requests\SignalProvider\LoginRequest;
use App\Mail\Mailings;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function activate(AccountActivationRequest $request){
        $provider = SignalProvider::where('verify_token', $request->verify_token)->first();
        if($provider->verify_token_expiry >= time()){
            $provider->password = Hash::make($request->password);
            $provider->status = 1;
            $provider->verify_token = NULL;
            $provider->verify_token_expiry = 0;
            $provider->save();

            if($authorization = $this->login_function($provider->email, $request->password)){
                $provider->authorization = $authorization;

                return response([
                    'status' => 'success',
                    'message' => 'Login successful',
                    'data' => $provider
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Signal Provider Login failed'
                ], 401);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Token already expired. Click on resend token'
            ], 401);
        }
    }

    public function login_function($email, $password){
        $auth = [
            'email' => $email,
            'password' => $password
        ];

        $provider = SignalProvider::where('email', $email)->first();
        if(!empty($provider)){
            if($token = auth('signalprovider-api')->attempt($auth)){
                $authorised = [
                    'token' => $token,
                    'type' => 'Bearer',
                    'expiry' =>  auth('signalprovider-api')->factory()->getTTL() * 60
                ];
                return $authorised;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function resend_token($old_token){
        $provider = SignalProvider::where('verify_token', $old_token)->first();
        if(!empty($provider)){
            $token = base64_encode($provider->id."Gemtrust".Str::random(20));
            $provider->verify_token = $token;
            $provider->verify_token_expiry = time() + (60 * 20);
            $provider->status = 0;
            $provider->save();

            Mail::to($provider)->send(new Mailings('Verification Link Reset', 'emails.resend_verify_token', [
                'title' => 'Verification Link Reset',
                'name' => $provider->name,
                'link' => env('APP_URL', 'https://gemtrustsolutions.com').'/signal-provider/activate/'.$token
            ]));

            return response([
                'status' => 'success',
                'message' => 'Activation Link Reset'
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Signal Provider was fetched'
            ], 404);
        }
    }

    public function login(LoginRequest $request){
        if($authorization  = $this->login_function($request->email, $request->password)){
            $provider = SignalProvider::where('email', $request->email)->first();

            $provider->authorization = $authorization;
            return response([
                'status' => 'success',
                'message' => 'Login successful',
                'data' => $provider
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Signal Provider Login Failed due to Wrong Credentials'
            ], 401);
        }
    }

    public function logout(){
        auth('signalprovider-api')->logout();

        return response([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ], 200);
    }
}
