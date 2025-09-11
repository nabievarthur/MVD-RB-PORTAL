<?php

namespace App\Http\Controllers\Admin\Leader;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Leader\IndexRequest;
use App\Http\Requests\Admin\Leader\LeaderStoreRequest;
use App\Http\Requests\Admin\Leader\LeaderUpdateRequest;
use App\Models\Leader;
use App\Repositories\Interfaces\LeaderInterface;
use App\Services\LeaderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class LeaderController extends Controller
{
    public function __construct(
        protected LeaderInterface        $leaderRepository,
        protected LeaderService          $leaderService,
    )
    {
    }

    public function index(IndexRequest $searchRequest): View
    {
        $dataRequest = $searchRequest->validated();

        return view('pages.admin.leader.index', [
            'leaders' => $dataRequest ? $this->leaderRepository->getFilterableLeaders($dataRequest) : $this->leaderRepository->getPaginatedLeaders(),
        ]);
    }

    public function store(LeaderStoreRequest $request): RedirectResponse
    {
        try {
            $success = $this->leaderService->storeLeader($request);

            if ($success) {
                return redirect()
                    ->route('admin.leader.index')
                    ->with('success', 'Руководитель успешно добавлен.');
            }

            return back()->with('error', 'Не удалось добавить руководителя.');

        } catch (Throwable $e) {
            return back()->with('error', 'Ошибка при создании руководителя: ' . $e->getMessage());
        }
    }

    public function edit(Leader $leader): View
    {
        return view('pages.admin.leader.edit', [
            'leader' => $this->leaderRepository->findLeaderById($leader->id),
        ]);
    }

    public function update(LeaderUpdateRequest $request, Leader $leader): RedirectResponse
    {
        try {
            $updatedLeader = $this->leaderService->updateLeader($leader, $request->validated());

            return redirect()
                ->route('admin.leader.edit', $updatedLeader->id)
                ->with('success', 'Данные руководителя обновлены');
        } catch (Throwable $e) {
            return back()->with('error', 'Ошибка обновления данных руководителя: ' . $e->getMessage());
        }
    }

    public function destroy(Leader $leader): RedirectResponse
    {
        try {
            $this->leaderService->deleteLeader($leader);

            return redirect()
                ->route('admin.leader.index')
                ->with('warning', 'Руководитель успешно удалён');
        } catch (Throwable $e) {
            return back()->with('error', 'Ошибка удаления руководителя: ' . $e->getMessage());
        }
    }


}
