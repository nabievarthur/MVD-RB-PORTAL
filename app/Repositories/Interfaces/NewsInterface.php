<?php

namespace App\Repositories\Interfaces;

use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;

interface NewsInterface
{
    public function findNewsById(int $newsId): ?News;

    public function getNewsCount(): int;

    public function getFilterableNews(array $data): LengthAwarePaginator;

    public function getPaginatedNews(): LengthAwarePaginator;

    public function createNews(array $newsData): ?News;

    public function updateNews(int $newsId, array $newsData): ?News;

    public function deleteNews(int $newsId): bool;
}
