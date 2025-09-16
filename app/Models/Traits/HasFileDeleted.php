<?php

namespace App\Models\Traits;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

trait HasFileDeleted
{
    protected static function booted(): void
    {
        static::deleting(function (self $model) {
            foreach ($model->files as $file) {

                /**
                 * @var File $file
                 */
                Storage::disk('public')->delete($file->path);
            }
        });
    }
}
