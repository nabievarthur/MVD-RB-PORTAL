<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\Home\ShortNewsResource;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::query()->orderBy('created_at', 'desc')->cursorPaginate(8);

        $news = ShortNewsResource::collection($news);

        return view('pages.home.index', compact('news'));
    }
}
