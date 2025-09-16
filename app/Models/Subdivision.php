<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subdivision extends Model
{
    use HasFilter;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
    ];

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
