<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class NewsFilter extends AbstractFilter
{
    protected array $keys = [
        'title',
    ];

    protected function title(Builder $builder, $value)
    {
        $builder->where('title', 'ilike', "%$value%")
            ->orWhere('description', 'ilike', "%$value%");
    }
}
