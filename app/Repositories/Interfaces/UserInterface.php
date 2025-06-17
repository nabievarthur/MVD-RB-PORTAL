<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Pagination\CursorPaginator;

interface UserInterface
{
    public function findUserById(int $userId): ?User;
    public function getFilterableUsers(array $data): CursorPaginator;
    public function getPaginatedUsers(): CursorPaginator;
    public function createUser(array $userData): ?User;
    public function updateUser(int $userId, array $userData): ?User;
    public function deleteUser(int $userId): ?bool;


}
