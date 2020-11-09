<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{

    public function authorize(){
        return true;
    }

    public function rules()
    {
        return [
            'content' => 'required|max:300',
            'post_id' => ['exists:posts,id']
        ];
    }
}
