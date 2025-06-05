<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Interfaces\RoleInterface;
use App\Repositories\Interfaces\SubdivisionInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected SubdivisionInterface $subdivisionRepository,
        protected RoleInterface $roleRepository,
    )
    {
    }

    public function index()
    {
        $users = User::query()->with('roles');

        $users = $users->cursorPaginate(10);

        $subdivisions = $this->subdivisionRepository->getSubdivisionList();

        $roles = $this->roleRepository->getRolesList();

        return view('pages.admin.user.index', compact('users', 'subdivisions', 'roles'));
    }

}
