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
        'registration_date',
        'start_time',
        'end_time',
        'absence_reason',
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

    /**
     * @return boolean
     */
    public function hasModifyRequests(): bool
    {
        return app()
            ->make(ModifyRequest::class)
            ->where('user_id', $this->user_id)
            ->where('registration_date', $this->registration_date)
            ->exists();
    }

    /**
     * @param integer $userId
     * @return Collection
     */
    public function fetchAttendancesByUserId(int $userId): Collection
    {
        return $this
            ->where('user_id', $userId)
            ->orderByDesc('registration_date')
            ->get();
    }

    /**
     * @param integer $userId
     * @return integer
     */
    public function countAttendancesByUserId(int $userId): int
    {
        return $this
            ->where('user_id', $userId)
            ->where('absence_flg', false)
            ->whereNotNull('start_time')
            ->whereNotNull('end_time')
            ->count();
    }

    /**
     * @param integer $userId
     * @return string
     */
    public function aggregateAttendancesTimeByUserId(int $userId): string
    {
        return $this
            ->selectRaw(
                'ROUND(
                    SUM(
                        TIME_TO_SEC(end_time) - TIME_TO_SEC(start_time)
                    ) / 3600
                ) as time'
            )
            ->where('user_id', $userId)
            ->where('absence_flg', false)
            ->whereNotNull('start_time')
            ->whereNotNull('end_time')
            ->first()
            ->time;
    }

    /**
     * @return boolean
     */
    public function isAbsence(): bool
    {
        return $this->absence_flg === 1;
    }

    /**
     * @return boolean
     */
    public function isAttendance(): bool
    {
        return !is_null($this->start_time) && is_null($this->end_time);
    }

    /**
     * @return boolean
     */
    public function isLeft(): bool
    {
        return !is_null($this->end_time);
    }
}
