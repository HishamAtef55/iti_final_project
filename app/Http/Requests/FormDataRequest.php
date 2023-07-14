<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDataRequest extends FormRequest
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
            'category_id' => 'required',
            'name' => 'required|min:2|max:50',
            'price' => 'required',
            'description' => 'required|string|max:900',
            'city_id' => 'required',
            'country_id' => 'required',
            'location' => 'required|string',
            'fileimage' => 'required',
            'attribute_id' => 'required',
            // // 'value' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is must',
            'name.min' => 'Name Must be 5 Character at least',
        ];
    }
}
