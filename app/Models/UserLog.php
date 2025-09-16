<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class UserLog extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'model_type',
        'model_id',
        'action',
        'data',
        'performed_by',
        'ip_address',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'array',
    ];
}
