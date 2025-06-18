<?php

namespace App\Enums;

enum CrudActionEnum: string
{
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case VIEW = 'view';
}
