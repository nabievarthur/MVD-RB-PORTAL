<?php

namespace App\Repositories;

use App\Models\Leader;
use App\Repositories\Interfaces\LeaderInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class LeaderRepository implements LeaderInterface
{
    private const CACHE_PREFIX_USER = 'leader:';
    private const CACHE_PREFIX_COUNT = 'leaders:count';
    private const CACHE_TTL = 1440; // 60 * 24, сутки

    public function findLeaderById(int $leaderId): ?Leader
    {
        $cacheKey = self::CACHE_PREFIX_USER . $leaderId;

        return Cache::tags(['leaders'])->remember(
            $cacheKey,
            self::CACHE_TTL,
            fn () => Leader::find($leaderId)
        );
    }

    public function getLeadersCount(): int
    {
        return Cache::tags(['leaders'])->remember(
            self::CACHE_PREFIX_COUNT,
            self::CACHE_TTL,
            fn () => Leader::count()
        );
    }

    public function getFilterableLeaders(array $filters): LengthAwarePaginator
    {
        return Leader::filter($filters)
            ->paginate(10)
            ->withQueryString();
    }

    public function getPaginatedLeaders(int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        return Leader::orderByDesc('created_at')
            ->paginate($perPage, ['*'], 'page', $page);
    }

    public function createLeader(array $leaderData): ?Leader
    {
        return DB::transaction(function () use ($leaderData) {
            $leader = Leader::create($leaderData);
            if ($leader) {
                $this->clearLeaderCache($leader->id);
            }
            return $leader;
        });
    }

    public function updateLeader(int $leaderId, array $leaderData): ?Leader
    {
        return DB::transaction(function () use ($leaderId, $leaderData) {
            $leader = Leader::find($leaderId);
            if (!$leader) {
                return null;
            }
            $updated = $leader->update($leaderData);

            if ($updated) {
                $this->clearLeaderCache($leaderId);
                return $leader->fresh();
            }
            return null;
        });
    }

    public function deleteLeader(int $leaderId): bool
    {
        return DB::transaction(function () use ($leaderId) {
            $leader = Leader::find($leaderId);
            if (!$leader) {
                return false;
            }
            $deleted = $leader->delete();
            if ($deleted) {
                $this->clearLeaderCache($leaderId);
            }
            return $deleted;
        });
    }

    protected function clearLeaderCache(int $leaderId): void
    {
        Cache::tags(['leaders'])->forget(self::CACHE_PREFIX_USER . $leaderId);
        Cache::tags(['leaders'])->forget(self::CACHE_PREFIX_COUNT);
    }
}
