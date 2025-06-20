<?php

namespace App\Http\Requests\Admin\OVD;

use Illuminate\Foundation\Http\FormRequest;

class OVDIndexRequest extends FormRequest
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
            'title' => 'nullable|string',
            'cod_ovd' => 'nullable|int',
        ];
    }
}
