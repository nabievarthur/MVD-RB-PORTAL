<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserInterface
{
    public function findUserById(int $userId): ?User;

    public function getUsersCount(): int;

    public function getUsers(array $filters): LengthAwarePaginator;

    public function createUser(array $userData): ?User;

    public function updateUser(int $userId, array $userData): ?User;

    public function deleteUser(int $userId): bool;
}
