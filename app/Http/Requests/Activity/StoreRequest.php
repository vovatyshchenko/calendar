<?php

namespace App\Http\Requests\Activity;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'quests' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'required|string|max:255',
            'time_start'=>'required|string|max:10',
            'time_end'=>'required|string|max:10',
            'date_start'=>'required|date_format:Y-m-d',
            'date_end'=>'required|date_format:Y-m-d|after_or_equal:date_start'
        ];
    }
}
