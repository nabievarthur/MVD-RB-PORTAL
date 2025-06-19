<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\IndexRequest;
use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Models\User;
use App\Repositories\Interfaces\OVDInterface;
use App\Repositories\Interfaces\RoleInterface;
use App\Repositories\Interfaces\SubdivisionInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class UserController extends Controller
{
    public function __construct(
        protected SubdivisionInterface $subdivisionRepository,
        protected RoleInterface        $roleRepository,
        protected UserInterface        $userRepository,
        protected UserService          $userService,
        protected OVDInterface         $ovdInterface
    )
    {
    }

    public function index(IndexRequest $searchRequest): View
    {
        $dataRequest = $searchRequest->validated();

        return view('pages.admin.user.index', [
            'users' => $dataRequest ? $this->userRepository->getFilterableUsers($dataRequest) : $this->userRepository->getPaginatedUsers(),
            'subdivisions' => $this->subdivisionRepository->getSubdivisionList(),
            'roles' => $this->roleRepository->getRolesList(),
            'ovd' => $this->ovdInterface->getOVDList(),
        ]);
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        try {
            $success = $this->userService->storeUser($request->validated());

            if ($success) {
                return back()->with('success', 'Пользователь успешно добавлен');
            }

            return back()->with('error', 'Не удалось создать пользователя.');

        } catch (Throwable $e) {
            return back()->with('error', 'Ошибка при создании пользователя: ' . $e->getMessage());
        }
    }

    public function edit(User $user): View
    {
        return view('pages.admin.user.edit', [
            'user' => $this->userRepository->findUserById($user->id),
            'subdivisions' => $this->subdivisionRepository->getSubdivisionList(),
            'roles' => $this->roleRepository->getRolesList(),
            'ovd' => $this->ovdInterface->getOVDList(),
        ]);
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        try {
            $updatedUser = $this->userService->updateUser($user, $request->validated());

            return redirect()
                ->route('admin.user.edit', $updatedUser->id)
                ->with('success', 'Данные пользователя обновлены');
        } catch (Throwable $e) {
            return back()->with('error', 'Ошибка обновления данных пользователя: ' . $e->getMessage());
        }
    }

    public function destroy(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', "Нельзя удалить самого себя");
        }

        try {
            $this->userService->deleteUser($user);

            return redirect()
                ->route('admin.user.index')
                ->with('warning', 'Пользователь успешно удалён');
        } catch (Throwable $e) {
            return back()->with('error', 'Ошибка удаления пользователя: ' . $e->getMessage());
        }
    }


}
