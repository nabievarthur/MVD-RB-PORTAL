<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,pdf,doc,docx,zip|max:30720',
            'files' => 'max:5',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if ($this->hasFile('files')) {
                $news = $this->route('news');

                if (! is_object($news) || ! method_exists($news, 'files')) {
                    return; // Прерываем выполнение, если это не объект модели
                }

                $existingFilesCount = $news->files()->count();
                $newFilesCount = count($this->file('files'));
                $totalFilesCount = $existingFilesCount + $newFilesCount;

                if ($totalFilesCount > 5) {
                    $validator->errors()->add('files', 'Общее количество файлов не может превышать 5 (уже есть: '.$existingFilesCount.', пытаетесь загрузить: '.$newFilesCount.')');
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Заголовок новости должен быть заполнен',
            'files.max' => 'Превышен лимит максимального количества файлов или размера',
        ];
    }
}
