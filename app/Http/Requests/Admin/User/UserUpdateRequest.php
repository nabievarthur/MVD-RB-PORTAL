<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'login' => ['required', 'string'],
            'password' => ['sometimes', 'confirmed'],
            'last_name' => ['nullable', 'string'],
            'first_name' => ['nullable', 'string'],
            'surname' => ['nullable', 'string'],
            'subdivision_id' => ['nullable', 'exists:subdivisions,id'],
            'role_id' => ['nullable', 'exists:roles,id'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->filled('role_id') && empty($this->subdivision_id)) {
                $validator->errors()->add(
                    'subdivision_id',
                    'Подразделение обязательно при указании роли.'
                );
            }
        });
    }
}
