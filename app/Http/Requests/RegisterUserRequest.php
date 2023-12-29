<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name'  => 'required|string|max:30',
            'password'   => 'required|string|min:8|max:30|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => '名前は30文字以内で記入してください。',
            'name.string' => '名前は文字列で記入してください。',
            'name.required' => '名前は必須です。',
            'password.required' => 'パスワードは必須です。',
            'password.mini' => 'パスワードは8文字以上30文字以内で記入してください。',
            'password.confirmed' => 'パスワードが確認用と一致していません。',
        ];
    }
}
