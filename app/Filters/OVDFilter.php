<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class OVDFilter extends AbstractFilter
{
    protected array $keys = [
        'title',
        'cod_ovd',
    ];

    protected function title(Builder $builder, $value)
    {
        $builder->where('title', 'ilike', "%$value%");
    }

    protected function codOvd(Builder $builder, $value)
    {
        $builder->where('cod_ovd', 'ilike', "%$value%");
    }
}
