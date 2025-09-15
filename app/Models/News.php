<?php

namespace App\Models;

use App\Filters\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    use HasFilter;

    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return void
     *              Удаляем изображения связанные с новостью при удалении новости
     */
    protected static function booted(): void
    {
        static::deleting(function (self $model) {
            foreach ($model->files as $file) {
                Storage::disk('public')->delete($file->path);
            }
        });
    }
}
