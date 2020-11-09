<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CreatePostRequest extends FormRequest
{

    public function authorize() {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'image' => [
                Rule::requiredIf(function(){
                    return $this->input('type') == 'create';
                }), 'image'
            ]
        ];
    }

}
