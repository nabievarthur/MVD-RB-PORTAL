<?php

namespace App\Services;

use App\Enums\CrudActionEnum;
use App\Http\Requests\News\StoreRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Models\News;
use App\Repositories\NewsRepository;
use App\Services\Log\ExceptionLogService;
use App\Services\Log\UserLogService;
use Throwable;

class NewsService
{
    public function __construct(
        protected NewsRepository $newsRepository,
        protected FileService $fileUploadService,
        protected UserLogService $userLogService,
        protected ExceptionLogService $exceptionLogService,
    ) {}

    /**
     * Создание новой новости.
     *
     * @throws Throwable
     */
    public function store(StoreRequest $request): News
    {
        $data = [];

        try {
            $data = $request->except(['_token', 'files']);

            $news = $this->newsRepository->createNews($data);

            $this->userLogService->log($news, CrudActionEnum::CREATE, $data);

            if ($request->hasFile('files')) {
                $this->fileUploadService->uploadFiles('news_files', $news, $request->file('files'));
            }

            return $news;
        } catch (Throwable $e) {
            $this->exceptionLogService->logException(
                CrudActionEnum::CREATE,
                $e,
                ['data' => $data]
            );
            throw $e;
        }
    }

    /**
     * Обновление существующей новости.
     *
     * @throws Throwable
     */
    public function update(UpdateRequest $request, News $news): News
    {
        $data = [];

        try {
            $oldData = $news->getOriginal();

            $data = $request->except(['_token', '_method', 'files']);

            $updatedNews = $this->newsRepository->updateNews($news->id, $data);

            if (! $updatedNews) {
                throw new \RuntimeException('Не удалось обновить новость.');
            }

            $this->userLogService->log($updatedNews, CrudActionEnum::UPDATE, [
                'old' => $oldData,
                'new' => $data,
            ]);

            if ($request->hasFile('files')) {
                $this->fileUploadService->uploadFiles('news_files', $news, $request->file('files'));
            }

            return $updatedNews;
        } catch (Throwable $e) {

            $this->exceptionLogService->logException(
                CrudActionEnum::UPDATE,
                $e,
                [
                    'news_id' => $news->id,
                    'data' => $data,
                ]
            );
            throw $e;
        }
    }

    /**
     * Удаление новости.
     *
     * @throws Throwable
     */
    public function delete(News $news): void
    {
        try {
            $oldData = $news->getOriginal();

            $this->newsRepository->deleteNews($news->id);

            $this->userLogService->log($news, CrudActionEnum::DELETE, [
                'old' => $oldData,
            ]);
        } catch (Throwable $e) {

            $this->exceptionLogService->logException(
                CrudActionEnum::DELETE,
                $e,
                [
                    'news_id' => $news->id,
                ]
            );
            throw $e;
        }
    }
}
