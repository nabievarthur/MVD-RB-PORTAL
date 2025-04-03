<?php

namespace App\Services;

use App\Http\Requests\News\StoreRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class NewsService
{


    /**
     * @throws Exception
     */

    public static function create(StoreRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();

        unset($data['files']);

        $news = News::query()->create($data);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('news_files', 'public');

                $news->files()->create([
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        if (!$news) {
            throw new Exception();
        }

        return $news;

    }
}
