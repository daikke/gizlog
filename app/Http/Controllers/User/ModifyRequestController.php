<?php
declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ModifyRequest;
use App\Services\ModifyRequestService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ModifyRequestController extends Controller
{
    private $modifyRequestService;

    public function __construct(ModifyRequestService $modifyRequestService)
    {
        $this->middleware('auth');
        $this->modifyRequestService = $modifyRequestService;
    }

    /**
     * @return View
     */
    public function showCreate(): View
    {
        return view('user.attendance.modify');
    }

    /**
     * @return View
     */
    public function store(ModifyRequest $request): RedirectResponse
    {
        $this->modifyRequestService->store($request->all(), Auth::id());
        return redirect()->route('attendance.create');
    }

}
