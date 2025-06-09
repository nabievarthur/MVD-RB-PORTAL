<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UserStoreRequest extends FormRequest
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
            'login' => ['required'],
            'password' => ['required', 'confirmed'],
            'last_name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'role_id' => ['sometimes', 'nullable', 'exists:roles,id'],
            'subdivision_id' => ['required', 'exists:subdivisions,id'],
        ];
    }

}
