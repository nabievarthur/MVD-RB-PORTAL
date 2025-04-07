<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\StoreRequest;
use App\Models\News;
use App\Services\NewsService;
use Exception;

class NewsController extends Controller
{
    public function __construct(private NewsService $newsService)
    {
    }

    public function create()
    {
        return view('pages.news.create');
    }

    public function show(News $news)
    {
        return view('pages.news.show', compact('news'));
    }
    public function store(StoreRequest $request)
    {
        try {
            $this->newsService->create($request);
            return redirect()->route('home')->with('success', 'Новость успешно добавлена !');
        } catch (Exception $e) {
            return redirect()->route('home')->with('error', 'Не удалось добавить новость. Пожалуйста, пвоторите попытку позже!');
        }
    }

    public function edit(News $news)
    {
        return view('pages.news.edit', compact('news'));
    }
}
