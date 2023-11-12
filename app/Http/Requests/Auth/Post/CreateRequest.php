<?php

namespace App\Http\Requests\Auth\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'title' => ['required', 'min:2', 'max:255', 'string'],
            'category' => ['required'],
            'status' => ['nullable'],
            'description' => ['required', 'min:10', 'max:5000'],
            'tags' => ['required', 'array'],
            'file' => ['mimes:jpg,png,pdf', 'max:2048', 'file']
        ];
    }
}
