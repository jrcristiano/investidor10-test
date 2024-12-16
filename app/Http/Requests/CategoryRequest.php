<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $categoryId = $this->route('id');

        if (!$categoryId) {
            return [
                'name' => 'required|string|min:3|max:255|unique:categories',
                'description' => 'nullable|string|max:255|unique:categories'
            ];
        }

        return [
            'name' => "required|string|min:3|max:255|unique:categories,name,{$categoryId}",
            'description' => "nullable|string|max:255|unique:categories,description,{$categoryId}",
        ];
    }
}
