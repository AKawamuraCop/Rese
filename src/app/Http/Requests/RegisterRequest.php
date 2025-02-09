<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255'],
            'password' => ['required','min:8','max:255','confirmed'],
            'auth' => ['required'],
        ];
    }
}
