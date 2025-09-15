<?php

namespace App\Http\Controllers\Admin\Subdivision;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Subdivision\SubdivisionIndexRequest;
use App\Http\Requests\Admin\Subdivision\SubdivisionStoreRequest;
use App\Http\Requests\Admin\Subdivision\SubdivisionUpdateRequest;
use App\Models\Subdivision;
use App\Repositories\Interfaces\SubdivisionInterface;
use App\Services\SubdivisionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class SubdivisionController extends Controller
{
    public function __construct(
        protected SubdivisionInterface $subdivisionRepository,
        protected SubdivisionService $subdivisionService,
    ) {}

    public function index(SubdivisionIndexRequest $searchRequest): View
    {
        $dataRequest = $searchRequest->validated();

        return view('pages.admin.subdivision.index',
            [
                'subdivisions' => $dataRequest ? $this->subdivisionRepository->getFilterableSubdivision($dataRequest) : $this->subdivisionRepository->getPaginatedSubdivision(),
            ]
        );
    }

    public function store(SubdivisionStoreRequest $request): RedirectResponse
    {
        try {
            $success = $this->subdivisionService->storeSubdivision($request->validated());

            if ($success) {
                return back()->with('success', 'ОВД успешно добавлен');
            }

            return back()->with('error', 'Не удалось создать ОВД.');
        } catch (Throwable $e) {
            return back()->with('error', 'Ошибка при создании ОВД: '.$e->getMessage());
        }
    }

    public function edit(Subdivision $subdivision): View
    {
        return view('pages.admin.subdivision.edit', [
            'subdivision' => $this->subdivisionRepository->findSubdivisionById($subdivision->id),
        ]);
    }

    public function update(Subdivision $subdivision, SubdivisionUpdateRequest $request): RedirectResponse
    {
        try {
            $updatedOvd = $this->subdivisionService->updateSubdivision($subdivision, $request->validated());

            return redirect()
                ->route('admin.subdivision.edit', $updatedOvd->id)
                ->with('success', 'Данные ОВД обновлены');
        } catch (Throwable $e) {
            return back()->with('error', 'Ошибка обновления данных ОВД: '.$e->getMessage());
        }
    }

    public function destroy(Subdivision $subdivision): RedirectResponse
    {
        try {
            $this->subdivisionService->deleteSubdivision($subdivision);

            return redirect()
                ->route('admin.subdivision.index')
                ->with('warning', 'ОВД успешно удалён');
        } catch (Throwable $e) {
            return back()->with('error', 'Ошибка удаления ОВД: '.$e->getMessage());
        }
    }
}
