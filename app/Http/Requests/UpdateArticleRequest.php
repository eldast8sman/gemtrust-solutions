<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'filename' => 'required|mimes:jpg,jpeg,png,gif',
            'section_id' => 'integer|exists:sections,id',
            'minimum_level' => 'required|integer|min:0',
            'author' => 'string',
            'release_date' => 'string'
        ];
    }
}
