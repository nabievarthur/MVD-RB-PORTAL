<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $path
 */
class File extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'fileable_id',
        'path',
        'original_name',
        'mime_type',
        'size',
    ];

    /**
     * @return BelongsTo
     */
    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }

    /**
     * @return MorphTo
     */
    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::deleting(function (self $model) {
            Storage::disk('public')->delete($model->path);
        });
    }
}
