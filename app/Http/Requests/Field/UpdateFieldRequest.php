<?php

namespace App\Http\Requests\Field;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFieldRequest extends FormRequest
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
            'field_name' => 'sometimes|string|max:50|unique:fields,field_name,' . $this->route('field'),
            'description' => 'nullable|string|max:500',
            'price_day' => 'sometimes|numeric|min:0',
            'price_night' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|in:available,unavailable',
        ];
    }
}
