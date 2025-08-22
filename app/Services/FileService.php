<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class FileService
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

    public function destroyFile(File $file): void
    {
        $file->delete();
        Cache::tags(['news'])->flush();

    }
}
