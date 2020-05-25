<?php

namespace App\Http\Requests\Search;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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

            'description' => 'required|string|max:255',
            'date_start'=>'required|date_format:Y-m-d',
            'date_end'=>'required|date_format:Y-m-d|after_or_equal:date_start',
            'search_area' => 'required',
        ];
    }
}
