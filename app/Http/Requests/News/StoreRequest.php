<?php

namespace App\Http\Requests\News;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'file.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,pdf,doc,docx,zip|max:30720',
            'file' => 'max:5'
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Заголовок новости должнен быть заполнен',
            'file.max' => 'Превышенно максимальное колличество файлов или размер'
        ];
    }
}
