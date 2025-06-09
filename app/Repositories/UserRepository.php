<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Pagination\CursorPaginator;

class UserRepository implements UserInterface
{
    public function __construct(
        protected User $user
    )
    {
    }

    public function getPaginatedUsers():CursorPaginator
    {
        return $this->user
            ->with('role')
            ->orderBy('created_at', 'desc')
            ->cursorPaginate(10);
    }
}
