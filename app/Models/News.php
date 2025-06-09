<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];
    public function scopeSearchQuery(Builder $query, $q)
    {
        $searchTerm = mb_strtolower($q);

        return $query->whereRaw('LOWER(title) LIKE ?', ['%' . $searchTerm . '%'])
            ->orWhereRaw('LOWER(description) LIKE ?', ['%' . $searchTerm . '%']);
    }

    public function scopeLatestWithUser(Builder $query): Builder
    {
        return $query->with('user')
            ->orderBy('created_at', 'desc');
    }
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return void
     * Удаляем изображения связанные с новостью при удалении новости
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
