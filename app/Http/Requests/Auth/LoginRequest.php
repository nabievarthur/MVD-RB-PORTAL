<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => 'required',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => 'Логин должен быть заполнен',
            'password.required' => 'Пароль должен быть заполнен'
        ];
    }
}
