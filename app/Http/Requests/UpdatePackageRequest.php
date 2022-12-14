<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
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
            'package' => 'required|string',
            'description' => 'string',
            'reg_amount' => 'required|numeric|min:1',
            'upline1' => 'numeric|min:1',
            'upline2' => 'numeric|min:1',
            'upline3' => 'numeric|min:1',
            'upline4' => 'numeric|min:1'
        ];
    }
}
