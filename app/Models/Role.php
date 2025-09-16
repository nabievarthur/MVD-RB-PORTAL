<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * @property string $title
     */
    public function getTitleAttribute($value): string
    {
        $titles = [
            'admin' => 'Администратор',
            'moder' => 'Модератор',
            'user' => 'Пользователь',
        ];

        return $titles[$value] ?? $value;
    }
}
