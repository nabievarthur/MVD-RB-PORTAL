<?php

namespace App\Http\Requests\Admin\Leader;

use App\Models\Leader;
use Illuminate\Foundation\Http\FormRequest;

class LeaderStoreRequest extends FormRequest
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
            'full_name' => ['required', 'string'],
            'rank' => ['required', 'string'],
            'position' => ['required', 'string'],
            'priority' => [
                'required',
                'in:minister,deputy_minister,deputy_police_chief,department_head',
                function ($attribute, $value, $fail) {
                    if ($value === 'minister' && Leader::where('priority', 'minister')->exists()) {
                        $fail('Может быть только один руководитель с приоритетом Министр.');
                    }
                },
            ],
            'file' => 'required|string',
        ];
    }
}
