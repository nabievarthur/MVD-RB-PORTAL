<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function getTitleAttribute($value): string
    {
        $titles = [
            'admin' => 'Администратор',
            'moder' => 'Модератор',
        ];

        return $titles[$value] ?? $value;
    }
}
