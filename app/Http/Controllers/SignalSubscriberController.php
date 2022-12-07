<?php

namespace App\Http\Controllers;

use App\Models\SignalSubscriber;
use Illuminate\Http\Request;

class SignalSubscriberController extends Controller
{
    private $user;

    public function __construct(){
        $this->middleware('auth:api');
        $this->user = AuthController::user();
    }

    public function subscribe(){
        $found = SignalSubscriber::where('user_id', $this->user->id);
        if($found->count() < 1){
            if($subscriber = SignalSubscriber::create([
                'user_id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'phone' => $this->user->phone
            ])){
                return response([
                    'status' => 'success',
                    'message' => 'Signal Provider Subscription was successful',
                    'data' => $subscriber
                ]);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Signal Subscription failed'
                ]);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'You have already subscribed to the Signal Provision Service'
            ], 409);
        }
    }

    public function unsubscribe(){
        $subscriber = SignalSubscriber::where('user_id', $this->user->id);
        if($subscriber->count() > 0){
            $subscriber = $subscriber->first();

            $subscriber->delete();

            return response([
                'status' => 'success',
                'message' => 'You have successfully unsubscribed from the Signal Providing Service'
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Subscription not found'
            ], 404);
        }
    }
}
