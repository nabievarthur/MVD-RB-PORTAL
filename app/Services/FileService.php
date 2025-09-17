<?php

namespace App\Services;

use App\Models\Contracts\HasFiles;
use App\Models\File;
use Illuminate\Support\Facades\Cache;

class FileService
{
    public function uploadFiles(string $folderName, HasFiles $model, $files): void
    {
        $files = is_array($files) ? $files : [$files];

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
        // Cache::tags(['news'])->flush();
        // Cache::tags(['leades'])->flush();

    }
}
