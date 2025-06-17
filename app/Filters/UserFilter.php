<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class UserFilter extends AbstractFilter
{
    protected array $keys = [
        'login',
        'last_name',
        'first_name',
        'surname',
        'role_id',
    ];

    protected function login(Builder $builder, $value)
    {
        $builder->where('login', 'ilike', "%$value%");
    }

    protected function lastName(Builder $builder, $value)
    {
        $builder->where('last_name', 'ilike', "%$value%");
    }

    protected function firstName(Builder $builder, $value)
    {
        $builder->where('first_name', 'ilike', "%$value%");
    }

    public function surname(Builder $builder, $value)
    {
        $builder->where('surname', 'ilike', "%$value%");
    }

    protected function roleId(Builder $builder, $value)
    {
        $builder->where('role_id',  $value);
    }
}
