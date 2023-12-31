<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'user_id'     => 'required',
            'product_id'  => 'required',
            'review'    => 'required',
            'star'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'user_id is required',
            'product_id.required' => 'product_id is required',
            'review.required' => 'review is required',
            'star.required' => 'star is required'
        ];
    }
}
