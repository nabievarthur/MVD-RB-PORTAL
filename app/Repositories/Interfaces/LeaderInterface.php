<?php

namespace App\Repositories\Interfaces;

use App\Models\Leader;
use Illuminate\Pagination\LengthAwarePaginator;

interface LeaderInterface
{
    public function findLeaderById(int $leaderId): ?Leader;
    public function getLeadersCount(): int;
    public function getFilterableLeaders(array $filters):LengthAwarePaginator;
    public function getPaginatedLeaders(): LengthAwarePaginator;
    public function createLeader(array $leaderData): ?Leader;
    public function updateLeader(int $leaderId, array $leaderData): ?Leader;
    public function deleteLeader(int $leaderId): bool;


}
