<?php

namespace App\Http\Requests\Field;

use Illuminate\Foundation\Http\FormRequest;

class StoreFieldRequest extends FormRequest
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
            'field_name' => 'required|string|max:50',
            'description' => 'nullable|string|max:500',
            'price_day' => 'required|numeric|min:0',
            'price_night' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
        ];
    }
}
