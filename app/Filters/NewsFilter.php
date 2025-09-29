<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class NewsFilter extends AbstractFilter
{
    protected array $keys = [
        'q',
    ];

    protected function q(Builder $builder, $value)
    {
        $builder->where('title', 'ilike', "%$value%")
            ->orWhere('description', 'ilike', "%$value%");
    }
}
