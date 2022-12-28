<?php

namespace App\Http\Requests\SignalProvider;

use Illuminate\Foundation\Http\FormRequest;

class StoreSignalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'currency_pair' => 'required|string',
            'order_type' => 'required|string',
            'lot_size' => 'required|string',
            'entry_price' => 'required|string',
            'take_profit1' => 'required|string',
            'stop_loss' => 'required|string'
        ];
    }
}
