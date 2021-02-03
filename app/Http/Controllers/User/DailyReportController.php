<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use Illuminate\View\View;

class DailyReportController extends Controller
{

    /**
     * 新規作成画面表示
     *
     * @return View
     */
    public function create(): View
    {
        return view('user.daily_report.create');
    }

    public function store(DailyReportRequest $request)
    {

    }
}
