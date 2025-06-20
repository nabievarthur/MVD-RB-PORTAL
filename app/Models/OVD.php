<?php

namespace App\Models;

use App\Filters\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;

class OVD extends Model
{
    use HasFilter;

    protected $table = 'ovd';

    protected $fillable = [
        'title',
        'cod_ovd',
    ];
}
