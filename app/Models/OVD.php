<?php

namespace App\Models;

use App\Models\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;

class OVD extends Model
{
    use HasFilter;

    /**
     * @var string
     */
    protected $table = 'ovd';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'cod_ovd',
    ];
}
