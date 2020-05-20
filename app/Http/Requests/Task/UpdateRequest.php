<?php

namespace App\Http\Requests\Task;

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
            'description' => 'string|max:255',
            'time_start'=>'required|string|max:10',
            'time_end'=>'required|string|max:10',
            'date_start'=>'required|date_format:Y-m-d',
            'date_end'=>'required|date_format:Y-m-d|after_or_equal:date_start',
            'is_remind'=>'boolean'
        ];
    }
}
