<?php

namespace App\Http\Controllers;

use App\Models\Signal;
use Illuminate\Http\Request;
use App\Models\SignalSubscriber;

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

    public function fetch_signals(){
        if(!empty(SignalSubscriber::where('user_id', $this->user->id)->first())){
            $name = !empty($_GET['name']) ? (string)$_GET['name'] : "";
            $pair = !empty($_GET['currency_pair']) ? (string)$_GET['surrency_pair'] : "";
            $limit = !empty($_GET{'limit'}) ? (int)$_GET['limit'] : 10;

            $signals = Signal::orderBy('created_at', 'desc');
            if(!empty($name)){
                $signals = $signals->where('name', 'like', '%'.$name.'%');
            }
            if(!empty($pair)){
                $signals = $signals->where('currency_pair', 'like', '%'.$pair.'%');
            }

            if($signals->count() > 0){
                return response([
                    'status' => 'success',
                    'message' => 'Signals fetched successfully',
                    'data' => $signals->paginate($limit)
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'No Signal was fetched'
                ], 404);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Not Subscribed to recieve Signals'
            ], 409);
        }
    }

    public function fetch_signal($id){
        if(!empty(SignalSubscriber::where('user_id', $this->user->id)->first())){
            if(!empty($signal = Signal::find($id))){
                return response([
                    'status' => 'success',
                    'message' => 'Signal fetched successfully',
                    'data' => $signal
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'No Signal was fetched'
                ], 404);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Not Subscribed to recieve Signals'
            ], 409);
        }
    }
}
