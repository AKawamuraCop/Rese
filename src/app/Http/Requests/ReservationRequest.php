<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['required','date','after_or_equal:today'],
            'time' => ['required'],
            'number' => ['required','integer']
        ];
    }
}
