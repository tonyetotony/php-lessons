<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:5|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.min' => 'Имя должно содержать не менее 5-ти символов!',
            'name.max' => 'Имя должно содержать не более 50-ти символов!',
            'password.confirmed' => 'Пароли не совпадают!',
        ];
    }
}