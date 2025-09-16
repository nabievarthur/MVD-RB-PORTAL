<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExceptionLog extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'service',
        'method',
        'message',
        'trace',
        'context',
    ];
}
