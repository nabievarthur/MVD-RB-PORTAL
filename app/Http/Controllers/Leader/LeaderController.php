<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\LeaderInterface;
use Illuminate\View\View;

class LeaderController extends Controller
{
    public function __construct(protected LeaderInterface $leaderRepository) {}

    public function index(): View
    {

        return view('pages.leader.index',
            [
                'leaders' => $this->leaderRepository->getPaginatedLeaders(),
            ]);

    }
}
