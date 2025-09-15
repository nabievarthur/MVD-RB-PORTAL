<?php

namespace App\Models;

use App\Filters\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subdivision extends Model
{
    use HasFilter;

    protected $fillable = [
        'title',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
