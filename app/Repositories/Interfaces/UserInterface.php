<?php

namespace App\Repositories\Interfaces;

use Illuminate\Pagination\CursorPaginator;

interface UserInterface
{
    public function getPaginatedUsers(): CursorPaginator;
}
