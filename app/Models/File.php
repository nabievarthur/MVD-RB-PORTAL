<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    protected $fillable = [
        'news_id',
        'path',
        'original_name',
        'mime_type',
        'size'
    ];

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (self $model) {
            Storage::disk('public')->delete($model->path);
        });
    }
}
