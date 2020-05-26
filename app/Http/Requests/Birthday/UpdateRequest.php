<?php

namespace App\Http\Requests\Birthday;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'time_start'=>'required|string|max:10',
            'date'=>'required|date_format:Y-m-d',
            'is_remind'=>'boolean',
        ];
    }
}
