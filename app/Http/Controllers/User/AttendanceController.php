<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AttendanceController extends Controller
{

    /**
     * @return View
     */
    public function showCreate(): View
    {
        return view('user.attendance.index');
    }

    public function showMyPage(): View
    {
        return view('user.attendance.mypage');
    }

    public function showCreateAbsence(): View
    {
        return view('user.attendance.absence');
    }

    public function showCreateModifyRequest(): View
    {
        return view('user.attendance.modify');
    }

    public function storeAttendance(): RedirectResponse
    {
        Auth::user()->attendanceState->storeAttendance();
        return redirect()->route('attendance.create');
    }

    public function storeAbsence(): RedirectResponse
    {
        $this->attendance->store();
        return redirect()->route('attendance.create');
    }

    public function storeModifyRequest(): RedirectResponse
    {
        $this->modifyRequest->store();
        return redirect()->route('attendance.create');
    }
}
