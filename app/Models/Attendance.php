<?php
declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'registration_date',
        'start_time',
        'end_time',
    ];

    /**
     * @param integer $userId
     * @return Attendance|null
     */
    public function fetchTodayAttendanceByUserId(int $userId): ?Attendance
    {
        return $this
            ->where('user_id', $userId)
            ->where('registration_date', Carbon::today()->format('Y-m-d'))
            ->first();
    }

    public function fetchRelatedModifyRequests(ModifyRequest $modifyRequests): Collection
    {
        return $modifyRequests
            ->where('user_id', $this->user_id)
            ->where('registration_date', $this->registration_date)
            ->get();
    }
}
