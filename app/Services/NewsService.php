<?php

namespace App\Services;

use App\Http\Requests\News\StoreRequest;
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
        $data = $request->validated();

        $data['user_id'] = Auth::id();

        unset($data['files']);

        $news = News::query()->create($data);

        if ($request->hasFile('files')) {
          $this->fileUploadService->uploadFiles('news_files', $news ,$request->file('files'));
        }

        if (!$news) {
            throw new Exception();
        }

        return $news;

    }
}
