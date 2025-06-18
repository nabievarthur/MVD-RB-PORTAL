<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $fillable = [
        'model_type',
        'model_id',
        'action',
        'data',
        'performed_by',
        'ip_address',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
