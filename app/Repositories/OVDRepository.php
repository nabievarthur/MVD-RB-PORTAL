<?php

namespace App\Repositories;

use App\Models\OVD;
use App\Repositories\Interfaces\OVDInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class OVDRepository implements OVDInterface
{
    private const CACHE_PREFIX_FOR_ALL_OVD = 'ovd:all';
    private const CACHE_PREFIX_FOR_ONE_OVD = 'ovd:single:';
    private const CACHE_TTL = 1440; // 60 * 24, сутки

    public function __construct(
        protected OVD $ovd
    )
    {}

    public function findOVDById(int $ovdId): ?OVD
    {
        $cacheKey = self::CACHE_PREFIX_FOR_ONE_OVD . $ovdId;

        return Cache::tags(['ovd'])->remember(
            $cacheKey,
            self::CACHE_TTL,
            fn() => $this->ovd->find($ovdId)
        );
    }

    public function getOVDList(): Collection
    {
        return Cache::tags(['ovd'])->remember(
            self::CACHE_PREFIX_FOR_ALL_OVD . '.list',
            60 * 60, // 1 час
            fn() => $this->ovd
                ->orderByDesc('title')
                ->pluck('title', 'id')
        );
    }

    public function getFilterableOVD(array $data): LengthAwarePaginator
    {
        return $this->ovd
            ->filter($data)
            ->paginate(10)
            ->withQueryString();
    }
    public function getPaginatedOVD(): LengthAwarePaginator
    {
        $perPage = 10;
        $page = (int) request()->get('page', 1);

        $ovds = Cache::tags(['ovd'])->remember(
            self::CACHE_PREFIX_FOR_ALL_OVD,
            self::CACHE_TTL,
            fn() => $this->ovd
                ->orderByDesc('created_at')
                ->orderByDesc('title')
                ->get()
        );

        $paged = $ovds->forPage($page, $perPage);

        return new LengthAwarePaginator(
            $paged->values(),
            $ovds->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    public function createOVD(array $ovdData): ?OVD
    {
        return DB::transaction(function () use ($ovdData) {
            $ovd = $this->ovd->create($ovdData);
            $this->clearOVDCache($ovd->id);
            return $ovd;
        });
    }

    public function updateOVD(int $ovdId, array $ovdData): ?OVD
    {
        return DB::transaction(function () use ($ovdId, $ovdData) {
            $ovd = $this->ovd->find($ovdId);
            if (!$ovd) {
                return null;
            }

            $updated = $ovd->update($ovdData);

            if ($updated) {
                $this->clearOVDCache($ovd->id);
                return $ovd;
            }

            return null;
        });
    }

    public function deleteOVD(int $ovdId): bool
    {
        return DB::transaction(function () use ($ovdId) {
            $ovd = $this->ovd->find($ovdId);

            if (!$ovd) {
                return false;
            }

            $deleted = $ovd->delete();
            if ($deleted) {
                $this->clearOVDCache($ovdId);
            }

            return $deleted;
        });
    }

    protected function clearOVDCache(int $ovdId): void
    {
        Cache::tags(['ovd'])->flush();
        Cache::forget(self::CACHE_PREFIX_FOR_ONE_OVD . $ovdId);
        Cache::forget(self::CACHE_PREFIX_FOR_ALL_OVD . '.list');
    }
}
