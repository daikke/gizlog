<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DailyReportController extends Controller
{
    public function create()
    {
        return view('user.daily_report.create');
    }

    public function store()
    {

    }
}
