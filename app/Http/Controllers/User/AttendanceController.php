<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AbsenceRequest;
use App\Services\AttendanceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    private $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->middleware('auth');
        $this->attendanceService = $attendanceService;
    }

    /**
     * @return View
     */
    public function showCreate(): View
    {
        $phase = $this->attendanceService->getAttendancePhaseByUserId(Auth::id());
        return view('user.attendance.index', compact('phase'));
    }

    /**
     * @return View
     */
    public function showMyPage(): View
    {
        $attendances = $this->attendanceService->fetchAttendancesByUserId(Auth::id());
        $attendancesCount = $this->attendanceService->countAttendancesByUserId(Auth::id());
        $attendancesTime = $this->attendanceService->aggregateAttendancesTimeByUserId(Auth::id());
        return view('user.attendance.mypage', compact('attendances', 'attendancesCount', 'attendancesTime'));
    }

    /**
     * @return View
     */
    public function showCreateAbsence(): View
    {
        return view('user.attendance.absence');
    }

    /**
     * @return View
     */
    public function showCreateModifyRequest(): View
    {
        return view('user.attendance.modify');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->attendanceService->store($request->all(), Auth::id());
        return redirect()->route('attendance.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateTodayAttendance(Request $request): RedirectResponse
    {
        $this->attendanceService->updateTodayAttendance($request->all(), Auth::id());
        return redirect()->route('attendance.create');
    }

    /**
     * @param AbsenceRequest $request
     * @return RedirectResponse
     */
    public function storeAbsence(AbsenceRequest $request): RedirectResponse
    {
        $this->attendanceService->storeAbsence($request->all(), Auth::id());
        return redirect()->route('attendance.create');
    }
}
