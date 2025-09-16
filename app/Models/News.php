<?php

namespace App\Models;

use App\Models\Contracts\HasFiles;
use App\Models\Traits\HasFileDeleted;
use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class News extends Model implements HasFiles
{
    use HasFileDeleted, HasFilter;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    /**
     * @return MorphMany
     */
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
