<?php

namespace App\Http\Requests\Admin\OVD;

use Illuminate\Foundation\Http\FormRequest;

class OVDUpdateRequest extends FormRequest
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
            'title' => 'required|string',
            'cod_ovd' => 'required|unique:ovd,cod_ovd,'.$this->ovd->id,
        ];
    }
}
