<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

trait HasFilter
{
    public function scopeFilter(Builder $builder, array $data): Builder|Response
    {
        $ClassName = 'App\\Filters\\'.class_basename($this).'Filter';

        if (! class_exists($ClassName)) {

            Log::error("Filter class not found: {$ClassName}");

            return $builder;
        }

        return (new $ClassName)->apply($data, $builder);

    }
}
