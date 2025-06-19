<?php

namespace App\Http\Controllers\Admin\OVD;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OVD\OVDStoreRequest;
use App\Repositories\Interfaces\OVDInterface;
use App\Services\OVDService;
use Illuminate\View\View;
use Throwable;

class OVDController extends Controller
{
    public function __construct(
        protected OVDInterface $ovdRepository,
        protected OVDService $ovdService,
    )
    {
    }

    public function index(): View
    {
        return view('pages.admin.ovd.index',
            [
                'ovd' => $this->ovdRepository->getPaginatedOVD(),
            ]
        );
    }

    public function store(OVDStoreRequest $request)
    {
        try {
            $success = $this->ovdService->storeOVD($request->validated());

            if ($success) {
                return back()->with('success', 'ОВД успешно добавлен');
            }

            return back()->with('error', 'Не удалось создать ОВД.');
        } catch (Throwable $e) {
            return back()->with('error', 'Ошибка при создании ОВД: ' . $e->getMessage());
        }
    }
}
