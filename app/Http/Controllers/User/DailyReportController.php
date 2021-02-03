<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use App\Models\DailyReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DailyReportController extends Controller
{

    public $dailyReport;

    public function __construct(DailyReport $dailyReport)
    {
        $this->dailyReport = $dailyReport;
    }

    /**
     * 新規作成画面表示
     *
     * @return View
     */
    public function create(): View
    {
        return view('user.daily_report.create');
    }

    /**
     * 日報登録
     *
     * @param DailyReportRequest $request
     * @return void
     */
    public function store(DailyReportRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $this->dailyReport->fill($inputs)->save();
        redirect(route('report.index'));
    }
}
