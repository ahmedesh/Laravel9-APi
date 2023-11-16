<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'     => 'required',
            'details'  => 'required',
            'price'    => 'required',
            'stock'    => 'required',
            'discount' => 'required'
            ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'name is required',
            'details.required'  => 'details is required',
            'price.required'    => 'price is required',
            'stock.required'    => 'stock is required',
            'discount.required' => 'discount is required',
            // Customize messages for other fields if needed
        ];
    }
}
