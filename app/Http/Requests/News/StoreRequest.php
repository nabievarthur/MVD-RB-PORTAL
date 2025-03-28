<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:30720'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Заголовок новости должнен быть заполнен',
            'file.max' => 'Превышен максимальный размер файла'
        ];
    }
}
