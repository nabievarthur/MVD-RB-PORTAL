<?php

namespace App\Repositories;

use App\Models\OVD;
use App\Repositories\Interfaces\OVDInterface;
use Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class OVDRepository implements OVDInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected OVD $ovd
    )
    {
    }

    public function getOVDList(): Collection
    {
        return Cache::remember('ovd.all', 3600, function () {
            return $this->ovd
                ->orderBy('title', 'desc')
                ->pluck('title', 'id');
        });

    }

    public function getPaginatedOVD(): LengthAwarePaginator
    {
        return $this->ovd
            ->orderBy('created_at', 'desc')
            ->orderBy('title', 'desc')
            ->paginate(10);
    }

    public function createOVD(array $data): ?OVD
    {
        $ovd = $this->ovd->create([
            'title' => $data['title'],
            'cod_ovd' => $data['cod_ovd'],
        ]);

        return $ovd;
    }

}
