<?php

namespace App\Repositories;

use App\Models\Subdivision;
use App\Repositories\Interfaces\SubdivisionInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SubdivisionRepository implements SubdivisionInterface
{
    private const CACHE_PREFIX_FOR_ALL_Subdivision = 'subdivision:all';
    private const CACHE_PREFIX_FOR_ONE_Subdivision = 'subdivision:single:';
    private const CACHE_TTL = 1440; // 60 * 24, сутки
    public function __construct(
        protected Subdivision $subdivision
    )
    {
    }

    public function findSubdivisionById(int $subdivisionId): ?Subdivision
    {
        $cacheKey = self::CACHE_PREFIX_FOR_ONE_Subdivision . $subdivisionId;

        return Cache::tags(['subdivision'])->remember(
            $cacheKey,
            self::CACHE_TTL,
            fn() => $this->subdivision->find($subdivisionId)
        );
    }

    public function getSubdivisionList(): Collection
    {
        return Cache::tags(['subdivision'])->remember(
            self::CACHE_PREFIX_FOR_ALL_Subdivision . '.list',
            60 * 60, // 1 час
            fn() => $this->subdivision
                ->orderByDesc('title')
                ->pluck('title', 'id')
        );
    }

    public function getFilterableSubdivision(array $data): LengthAwarePaginator
    {
        return $this->subdivision
            ->filter($data)
            ->paginate(10)
            ->withQueryString();
    }
    public function getPaginatedSubdivision(): LengthAwarePaginator
    {
        $perPage = 10;
        $page = (int) request()->get('page', 1);

        $subdivisions = Cache::tags(['subdivision'])->remember(
            self::CACHE_PREFIX_FOR_ALL_Subdivision,
            self::CACHE_TTL,
            fn() => $this->subdivision
                ->orderByDesc('created_at')
                ->orderByDesc('title')
                ->get()
        );

        $paged = $subdivisions->forPage($page, $perPage);

        return new LengthAwarePaginator(
            $paged->values(),
            $subdivisions->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    public function createSubdivision(array $subdivisionData): ?Subdivision
    {
        return DB::transaction(function () use ($subdivisionData) {
            $subdivision = $this->subdivision->create($subdivisionData);
            $this->clearSubdivisionCache($subdivision->id);
            return $subdivision;
        });
    }

    public function updateSubdivision(int $subdivisionId, array $subdivisionData): ?Subdivision
    {
        return DB::transaction(function () use ($subdivisionId, $subdivisionData) {
            $subdivision = $this->subdivision->find($subdivisionId);
            if (!$subdivision) {
                return null;
            }

            $updated = $subdivision->update($subdivisionData);

            if ($updated) {
                $this->clearSubdivisionCache($subdivision->id);
                return $subdivision;
            }

            return null;
        });
    }

    public function deleteSubdivision(int $subdivisionId): bool
    {
        return DB::transaction(function () use ($subdivisionId) {
            $subdivision = $this->subdivision->find($subdivisionId);

            if (!$subdivision) {
                return false;
            }

            $deleted = $subdivision->delete();
            if ($deleted) {
                $this->clearSubdivisionCache($subdivisionId);
            }

            return $deleted;
        });
    }

    protected function clearSubdivisionCache(int $subdivisionId): void
    {
        Cache::tags(['subdivision'])->flush();
        Cache::forget(self::CACHE_PREFIX_FOR_ONE_Subdivision . $subdivisionId);
        Cache::forget(self::CACHE_PREFIX_FOR_ALL_Subdivision . '.list');
    }
}
