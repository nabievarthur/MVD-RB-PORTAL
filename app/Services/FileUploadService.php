<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class FileUploadService
{
    public function uploadFiles(string $folderName, Model $model, array $files): void
    {
        foreach ($files as $file) {
            $path = $file->store($folderName, 'public');

            $model->files()->create([
                'path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
        }
    }
}
