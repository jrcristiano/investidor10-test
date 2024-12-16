<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
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
        $articleId = $this->route('id') ?? null;

        $rules = [
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => [
                'required',
                'string',
                Rule::unique('articles')->ignore($articleId), // Garante a unicidade, exceto para o próprio artigo sendo editado
            ],
            'subtitle' => 'required|string|min:3|max:255',
            'content' => 'required|string|min:5',
            'status' => 'required|in:rascunho,publicado',
            'category_id' => 'required|numeric|exists:categories,id',
        ];

        if ($articleId) {
            $rules['banner'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }
}
