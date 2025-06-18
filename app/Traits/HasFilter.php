<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;

trait HasFilter
{
    public function scopeFilter(Builder $builder, array $data): Builder|Response
    {
        $ClassName = 'App\\Filters\\' . class_basename($this) . 'Filter';


        if (!class_exists($ClassName)) {
            return response([
                'message' => 'Filter class not found',
            ], Response::HTTP_NOT_FOUND);
        }

        return (new $ClassName)->apply($data, $builder);

    }
}

