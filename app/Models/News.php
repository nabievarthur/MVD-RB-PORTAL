<?php

namespace App\Models;

use App\Models\Contracts\HasFiles;
use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class News extends Model implements HasFiles
{
    use HasFilter;

    /**
     * @var list<string>
     */
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
     * @return iterable<File>
     */
    public function getFiles(): iterable
    {
        /** @var iterable<File> $files */
        $files = $this->files;

        return $files;
    }
}
