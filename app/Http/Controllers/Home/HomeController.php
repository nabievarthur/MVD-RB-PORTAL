<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\Home\ShortNewsResource;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->has('q') ? News::searchQuery($request->q) : News::latestWithUser();

        $news = $query->cursorPaginate(8);

        return view('pages.home.index', ['news' => ShortNewsResource::collection($news)]);
    }
}
