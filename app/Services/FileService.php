<?php

namespace App\Services;

use App\Models\Contracts\HasFiles;
use Illuminate\Database\Eloquent\Model;
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

    public function destroyFile(Model $file): void
    {
        $file->delete();
        // Cache::tags(['news'])->flush();
        // Cache::tags(['leades'])->flush();

    }
}
