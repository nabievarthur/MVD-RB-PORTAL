<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\StoreRequest;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function create()
    {
        return view('pages.news.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        dd($data);
    }
}
