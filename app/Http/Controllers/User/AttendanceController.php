<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AttendanceController extends Controller
{

    /**
     * @return View
     */
    public function showCreatePage(): View
    {
        return view('user.attendance.index');
    }
}
