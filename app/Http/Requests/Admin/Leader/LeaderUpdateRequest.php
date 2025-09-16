<?php

namespace App\Http\Requests\Admin\Leader;

use Illuminate\Foundation\Http\FormRequest;

class LeaderUpdateRequest extends FormRequest
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
            'full_name' => ['required', 'string', 'unique:users,login'],
            'rank' => ['required', 'string'],
            'position' => ['required', 'string'],
            'priority' => 'required|in:minister,deputy_minister,deputy_police_chief,department_head',
            'file' => 'sometimes|image|mimes:jpeg,jpg,png,gif,pdf|max:2048',
        ];
    }
}
