<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\OVDRepository;
use App\Repositories\SubdivisionRepository;
use App\Repositories\UserRepository;

class AdminController extends Controller
{
    public function __construct(
        protected UserRepository $userRepository,
        protected SubdivisionRepository $subdivisionRepository,
        protected OvdRepository $ovdRepository
    ) {}

    public function index()
    {
        return view('pages.admin.index',
            [
                'usersCount' => $this->userRepository->getUsersCount(),
                'subdivisionsCount' => $this->subdivisionRepository->getSubdivisionCount(),
                'ovdCount' => $this->ovdRepository->getOvdCount(),
            ]
        );
    }
}
