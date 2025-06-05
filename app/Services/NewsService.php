<?php

namespace App\Services;

use App\Http\Requests\News\StoreRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Models\News;
use Exception;
use Illuminate\Support\Facades\Auth;

class NewsService
{
    public function __construct(public FileUploadService $fileUploadService)
    {
    }

    /**
     * @throws Exception
     */

    public function create(StoreRequest $request)
    {
        $data = $request->except(['_token', 'files']);

        $news = News::query()->create($data);

        if (!$news) {
            throw new Exception();
        }

        if ($request->hasFile('files')) {
          $this->fileUploadService->uploadFiles('news_files', $news ,$request->file('files'));
        }

        return $news;

    }

    public function update(UpdateRequest $request, News $news)
    {
        $data = $request->except(['_token','_method', 'files']);

        $news->update($data);

        if ($request->hasFile('files')) {
            $this->fileUploadService->uploadFiles('news_files', $news ,$request->file('files'));
        }

        return $news;
    }
}
