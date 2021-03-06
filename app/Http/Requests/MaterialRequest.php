<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Policies\MaterialPolicy;
use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return MaterialPolicy::authCheck();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'serial' => 'required|max:255',
            'cost_price' => 'required|numeric',
            'selling_price' => 'required|numeric|gt:cost_price',
            'group' => 'required',
            'not' => 'required',
            // validate for pricing
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
