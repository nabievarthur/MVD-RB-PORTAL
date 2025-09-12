<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Repositories\LeaderRepository;
use \Illuminate\View\View;

class LeaderController extends Controller
{
    public function __construct(protected LeaderRepository $leaderRepository)
    {
    }

    public function index(): View
    {

        return view('pages.chief.index',
        [
            'leaders' => $this->leaderRepository->getPaginatedLeaders()
        ]);

    }
}
