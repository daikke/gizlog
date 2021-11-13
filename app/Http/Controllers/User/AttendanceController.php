<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AttendanceController extends Controller
{

    /**
     * @return View
     */
    public function create(): View
    {
        return view('user.attendance.index');
    }
}
