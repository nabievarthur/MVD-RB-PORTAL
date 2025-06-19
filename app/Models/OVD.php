<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OVD extends Model
{
    protected $table = 'ovd';

    protected $fillable = [
        'title',
        'cod_ovd',
    ];
}
