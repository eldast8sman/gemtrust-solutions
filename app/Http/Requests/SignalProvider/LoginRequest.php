<?php

namespace App\Http\Requests\SignalProvider;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|string|exists:signal_providers,email',
            'password' => [
                'required',
                'string',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ]
        ];
    }
}
