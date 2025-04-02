<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Exception;

class NewsService
{


    /**
     * @throws Exception
     */

    public static function create(array $data)
    {

        $data['user_id'] = Auth::id();

        $news = News::query()->create($data);

        if (!$news) {
            throw new Exception();
        }

        return $news;

    }
}
