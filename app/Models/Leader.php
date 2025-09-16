<?php

namespace App\Models;

use App\Filters\Traits\HasFilter;
use App\Models\Contracts\HasFiles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Leader extends Model implements HasFiles
{
    use HasFilter;

    protected $fillable = [
        'full_name',
        'rank',
        'position',
        'priority',
    ];

    public function getPriorityAttribute($value): string
    {
        $priority = [
            'minister' => 'Министр внутренних дел',
            'deputy_minister' => 'Заместитель министра',
            'deputy_police_chief' => 'Заместитель начальника полиции',
            'department_head' => 'Начальник управления и прочее',
        ];

        return $priority[$value] ?? $value;
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
