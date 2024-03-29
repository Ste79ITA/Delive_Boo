<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|String',
            'description' => 'required|String',
            'price' => 'required|regex:/^\d{1,6}(\.\d{1,2})?$/' ,
            'image' =>   'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:7168',
            'available' => 'nullable',
            // 'restaurant_id' => 'required'

        ];
    }
}
