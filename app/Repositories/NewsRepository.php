<?php

namespace App\Repositories;

use App\Models\News;
use App\Repositories\Interfaces\NewsInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class NewsRepository implements NewsInterface
{
    private const CACHE_PREFIX_FOR_ALL_NEWS = 'news:all';
    private const CACHE_PREFIX_FOR_ONE_NEWS = 'news:single:';
    private const CACHE_TTL = 1440; // 60 * 24, сутки

    public function __construct(
        protected News $news
    ) {}

    /**
     * Получить новость по ID.
     */
    public function findNewsById(int $newsId): ?News
    {
        $cacheKey = self::CACHE_PREFIX_FOR_ONE_NEWS . $newsId;

        return Cache::tags(['news'])->remember(
            $cacheKey,
            self::CACHE_TTL,
            fn() => $this->news->find($newsId)
        );
    }

    /**
     * Получить количество всех новостей.
     */
    public function getNewsCount(): int
    {
        return Cache::tags(['news'])->remember(
            'news:count',
            self::CACHE_TTL,
            fn() => $this->news->count()
        );
    }

    /**
     * Получить фильтруемые новости с пагинацией.
     */
    public function getFilterableNews(array $data): LengthAwarePaginator
    {
        return $this->news
            ->filter($data)
            ->with(['user', 'files'])
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();
    }

    /**
     * Получить все новости с пагинацией.
     */
    public function getPaginatedNews(): LengthAwarePaginator
    {
        $perPage = 10;
        $page = (int)request()->get('page', 1);

        $news = Cache::tags(['news'])->remember(
            self::CACHE_PREFIX_FOR_ALL_NEWS,
            self::CACHE_TTL,
            fn() => $this->news
                ->with(['user', 'files'])
                ->orderByDesc('created_at')
                ->get()
        );

        $paged = $news->forPage($page, $perPage);

        return new LengthAwarePaginator(
            $paged->values(),
            $news->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    /**
     * Создать новость.
     */
    public function createNews(array $newsData): ?News
    {
        return DB::transaction(function () use ($newsData) {
            $news = $this->news->create($newsData);
            if ($news) {
                $this->clearNewsCache($news->id);
            }
            return $news;
        });
    }

    /**
     * Обновить новость.
     */
    public function updateNews(int $newsId, array $newsData): ?News
    {
        return DB::transaction(function () use ($newsId, $newsData) {
            $news = $this->news->find($newsId);
            if (!$news) {
                return null;
            }

            $updated = $news->update($newsData);

            if ($updated) {
                $this->clearNewsCache($news->id);
                return $news;
            }

            return null;
        });
    }

    /**
     * Удалить новость.
     */
    public function deleteNews(int $newsId): bool
    {
        return DB::transaction(function () use ($newsId) {
            $news = $this->news->find($newsId);

            if (!$news) {
                return false;
            }

            $deleted = $news->delete();
            if ($deleted) {
                $this->clearNewsCache($newsId);
            }

            return $deleted;
        });
    }

    /**
     * Очистить кэш для новостей.
     */
    protected function clearNewsCache(int $newsId): void
    {
        Cache::tags(['news'])->flush();
        Cache::forget(self::CACHE_PREFIX_FOR_ONE_NEWS . $newsId);
        Cache::forget('news:count');
    }
}
