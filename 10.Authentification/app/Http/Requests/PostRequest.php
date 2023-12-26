<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:8'],
            'slug' => [
                'required',
                'string',
                'min:8',
                Rule::unique('posts')->ignore($this->route()->parameter('post'))
            ],
            'content' => ['required', 'string', 'min:8', 'max:100'],
            'categorie_id' => '',
        ];
    }
}