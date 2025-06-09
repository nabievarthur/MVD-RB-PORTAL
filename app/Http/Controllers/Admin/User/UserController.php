<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Models\User;
use App\Repositories\Interfaces\RoleInterface;
use App\Repositories\Interfaces\SubdivisionInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        protected SubdivisionInterface $subdivisionRepository,
        protected RoleInterface        $roleRepository,
        protected UserInterface        $userRepository,
        protected UserService          $userService
    )
    {
    }

    public function index()
    {
        return view('pages.admin.user.index', [
            'users' => $this->userRepository->getPaginatedUsers(),
            'subdivisions' => $this->subdivisionRepository->getSubdivisionList(),
            'roles' => $this->roleRepository->getRolesList(),
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        $result = $this->userService->storeUser($request->validated());

        if (!$result) {
            return redirect()->back()->with('error', 'Не удалось создать пользователя');
        }

        return redirect()->back()->with('success', 'Пользователь успешно добавлен');
    }

    public function edit(User $user)
    {
        return view('pages.admin.user.edit', [
            'user' => $user,
            'subdivisions' => $this->subdivisionRepository->getSubdivisionList(),
            'roles' => $this->roleRepository->getRolesList(),
        ]);
    }

}
