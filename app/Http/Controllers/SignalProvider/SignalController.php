<?php

namespace App\Http\Controllers\SignalProvider;

use App\Models\Signal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignalProvider\StoreSignalRequest;
use App\Mail\Mailings;
use App\Models\SignalSubscriber;
use Illuminate\Support\Facades\Mail;

class SignalController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->middleware('auth:signalprovider-api');
        $this->user = AuthController::user();
    }

    public function store(StoreSignalRequest $request){
        $all = $request->all();
        $all['signal_provider_id'] = $this->user->id;
        $all['signal_provider'] = $this->user->name;

        if($signal = Signal::create($all)){
            if(!empty($subscribers = SignalSubscriber::all())){
                set_time_limit(20);
                foreach($subscribers as $subscriber){
                    Mail::to($subscriber)->send(new Mailings('Signal From Gemtrust - '.date('Y-m-d H:i:s'), 'emails.signals', [
                        'title' => 'Signal From Gemtrust - '.date('Y-m-d H:i:s'),
                        'name' => $subscriber->name,
                        'currency_pair' => $signal->currency_pair,
                        'order_type' => $signal->order_type,
                        'lot_size' => $signal->lot_size,
                        'entry_price' => $signal->entry_price,
                        'take_profit1' => $signal->take_profit1,
                        'take_profit2' => $signal->take_profit2,
                        'take_profit3' => $signal->take_profit3,
                        'stop_loss' => $signal->stop_loss,
                        'remarks' => $signal->remarks,
                        'sender' => $this->user->name
                    ], "signals@gemtrustsolutions.com", $this->user->name."from Gemtrust"));
                }
            }

            return response([
                'status' => 'success',
                'message' => 'Signal Saved and Sent successfully',
                'data' => $signal
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'Could not create Signal'
            ], 500);
        }
    }

    public function index(){ 
        $search = !empty($_GET['search']) ? (string)$_GET['search'] : "";
        $limit = !empty($_GET['limit']) ? (int)$_GET['limit'] : 10;

        $signals = Signal::where('signal_provider_id', $this->user->id);
        if(!empty($search)){
            $signals = $signals->where('currency_pair', 'like', '%'.$search.'%');
        }
        $signals = $signals->orderBy('created_at', 'desc');
        if($signals->count() > 0){
            return response([
                'status' => 'success',
                'message' => 'Signals fetched successfully',
                'data' => $signals->paginate($limit)
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'You have not sent any Signal'
            ], 404);
        }
    }

    public function show($id){
        if(!empty($signal = Signal::find($id))){
            if($signal->signal_provider_id == $this->user->id){
                return response([
                    'status' => 'success',
                    'message' => 'Signal fetched successfully',
                    'data' => $signal
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Not a Signal sent by you'
                ], 409);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Signal was fetched'
            ], 404);
        }
    }
}
