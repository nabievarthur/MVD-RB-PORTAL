<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\IndexRequest;
use App\Http\Requests\News\StoreRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Models\News;
use App\Repositories\Interfaces\NewsInterface;
use App\Services\NewsService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class NewsController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        protected NewsInterface $newsRepository,
        protected NewsService $newsService,
    ) {}

    /**
     * Страница списка новостей.
     */
    public function index(IndexRequest $searchRequest): View
    {
        $dataRequest = $searchRequest->validated();

        return view('pages.news.index', [
            'news' => $dataRequest ? $this->newsRepository->getFilterableNews($dataRequest) : $this->newsRepository->getPaginatedNews(),
        ]);
    }

    /**
     * Страница создания новости.
     */
    public function create(): View
    {
        $this->authorize('create', News::class);
        return view('pages.news.create');
    }

    /**
     * Создание новости.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->authorize('create', News::class);

        try {
            $success = $this->newsService->store($request);

            if ($success) {
                return redirect()
                    ->route('home')
                    ->with('success', 'Новость успешно добавлена.');
            }

            return back()->with('error', 'Не удалось создать новость.');

        } catch (Throwable $e) {
            return back()->with('error', 'Ошибка при создании новости: ' . $e->getMessage());
        }
    }

    /**
     * Страница просмотра новости.
     */
    public function show(News $news): View
    {
        return view('pages.news.show', [
            'news' => $this->newsRepository->findNewsById($news->id),
        ]);
    }

    /**
     * Страница редактирования новости.
     */
    public function edit(News $news): View
    {
        $this->authorize('update', $news);

        return view('pages.news.edit', [
            'news' => $this->newsRepository->findNewsById($news->id),
        ]);
    }

    /**
     * Обновление новости.
     */
    public function update(News $news, UpdateRequest $request): RedirectResponse
    {
        $this->authorize('update', $news);

        try {
            $updatedNews = $this->newsService->update($request, $news);

            return redirect()
                ->route('news.show', $updatedNews->id)
                ->with('success', 'Данные новости обновлены.');
        } catch (Throwable $e) {
            return back()->with('error', 'Ошибка обновления данных новости: ' . $e->getMessage());
        }
    }

    /**
     * Удаление новости.
     */
    public function destroy(News $news): RedirectResponse
    {
        $this->authorize('delete', $news);

        try {
            $this->newsService->delete($news);

            return redirect()
                ->route('home')
                ->with('warning', 'Новость успешно удалена.');
        } catch (Throwable $e) {
            return back()->with('error', 'Ошибка удаления новости: ' . $e->getMessage());
        }
    }
}
