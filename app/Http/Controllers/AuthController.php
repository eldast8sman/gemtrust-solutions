<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\Mailings;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ActivateUserRequest;
use App\Http\Requests\ResendUserTokenRequest;
use App\Http\Requests\UserResetPasswordRequest;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $all = $request->all();
        $time = time();
        $all['password'] = Hash::make($all['password']);
        $all['status'] = 2;
        $all['verification_token'] = Str::random(20).$time;
        $all['verification_token_expiry'] = date('Y-m-d H:i:s', $time + (60 * 20));
        if($user = User::create($all)){
            Mail::to($user)->send(new Mailings("Account Activation", "emails.activate_account", [
                "title" => "Account Activation",
                "name" => $user->name,
                "link" => env('APP_URL', 'https://gemtrustsolutions.com').'/portal/activate/'.$user->verification_token
            ]));

            if($token = auth('api')->attempt([
                'email' => $request->email,
                'password' => $request->password
            ])){
                $user->authorization = [
                    'token' => $token,
                    'type' => "Bearer",
                    'expiry' => auth('api')->factory()->getTTL() * 60
                ];

                return response([
                    'status' => 'success',
                    'message' => 'Account created successfully',
                    'data' => $user
                ]);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'User could not be logged in'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Account could not be create'
            ], 500);
        }
    }

    public function login(UserLoginRequest $request){
        $all = $request->all();

        if($token = auth('api')->attempt($all)){
            $admin = User::where('email', $all['email'])->first();
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

    public function activate_user(ActivateUserRequest $request){
        $user = User::where('verification_token', $request->verification_token)->first();
        if(time() <= strtotime($user->verification_token_expiry)){
            $user->verification_token = null;
            $user->verification_token_expiry = null;
            $user->status = 1;
            $user->save();

            return response([
                'status' => 'success',
                'message' => 'User Activation was successful',
                'data' => $user
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Verification Link has expired. Please resend activation link to get a new Activation Link'
            ], 409);
        }
    }

    public function resend_verification_link(ResendUserTokenRequest $request){
        $user = User::where('email', $request->email)->first();

        if($user->status == 2){
            $time = time();
            $user->verification_token = Str::random(20).$time;
            $user->verification_token_expiry = date('Y-m-d H:i:s', $time + (60 * 20));
            $user->save();
            Mail::to($user)->send(new Mailings("Activation Link Resent", "emails.resend_user_verification_link", [
                'title' => 'Verification Link Reset',
                'name' => $user->name,
                'link' => env('APP_URL', 'https://gemtrustsolutions.com').'/users/activate/'.$user->verification_token
            ]));

            return response([
                'status' => 'success',
                'message' => 'Activation Link Reset'
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Account already verified/activated'
            ], 409);
        }
    }

    public function forgot_password(ResendUserTokenRequest $request){
        $user = User::where('email', $request->email)->first();

        $user->token = base64_encode($user->id.Str::random(20).time());
        $user->token_expiry = date('Y-m-d H:i:s', time() + (60 * 10));
        $user->save();

        Mail::to($user)->send(new Mailings("Reset Password", "emails.forgot_password", [
            "title" => "Account Activation",
            "name" => $user->name,
            "link" => env('APP_URL', 'https://gemtrustsolutions.com').'/portal/reset-password/'.$user->token
        ]));

        return response([
            'status' => 'success',
            'message' => 'Password reset link sent to '.$user->email
        ], 200);
    }

    public function reset_password(UserResetPasswordRequest $request){
        $user = User::where('token', $request->token)->first();

        if(time() <= strtotime($user->token_expiry)){
            $user->update([
                'password' => Hash::make($request->password),
                'token' => null,
                'token' => null,
            ]);

            return response([
                'status' => 'success',
                'message' => 'Password updated successfully',
                'data' => $user
            ], 200);
        } else {
            $user->token = null;
            $user->token_expiry = null;
            $user->save();

            return response([
                'status' => 'failed',
                'message' => 'Password reset link has expired'
            ], 404);
        }
    }

    public static function user(){
        return auth('api')->user();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function logout(){
        auth('api')->logout();

        return response([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ], 200);
    }
}
