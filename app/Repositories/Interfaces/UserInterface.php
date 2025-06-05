<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Pagination\CursorPaginator;

interface UserInterface
{
    public function getPaginatedUsers(): CursorPaginator;
}
