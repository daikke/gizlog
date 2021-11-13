<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceService
{
    public const UNREGISTERED = 'unregistered';
    public const ABSENCE = 'absence';
    public const ATTENDANCE = 'attendance';
    public const LEFT = 'left';
    private $attendance;

    /**
     * @param Attendance $attendance
     */
    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    /**
     * @param integer $userId
     * @return string
     */
    public function getAttendancePhaseByUserId(int $userId): string
    {
        $attendance = $this->attendance->fetchTodayAttendanceByUserId($userId);

        if ($this->isUnRegistered($attendance)) {
            return self::UNREGISTERED;
        }

        if ($this->isAbsence($attendance)) {
            return self::ABSENCE;
        }

        if ($this->isAttendance($attendance)) {
            return self::ATTENDANCE;
        }

        if ($this->isLeft($attendance)) {
            return self::LEFT;
        }
    }

    /**
     * @param array $input
     * @param integer $userId
     * @return void
     */
    public function store(array $input, int $userId): void
    {
        $this->attendance->user_id = $userId;
        $this->attendance->absence_flg = false;
        $this->attendance->fill($input)->save();
    }

    /**
     * @param array $input
     * @param integer $userId
     * @return void
     */
    public function updateTodayAttendance(array $input, int $userId): void
    {
        $attendance = $this->attendance->fetchTodayAttendanceByUserId($userId);
        $attendance->fill($input)->save();
    }

    /**
     * @param array $input
     * @param integer $userId
     * @return void
     */
    public function storeAbsence(array $input, int $userId): void
    {
        $attendance = $this->attendance->fetchTodayAttendanceByUserId($userId);
        $input['registration_date'] = Carbon::today()->format('Y-m-d');
        if ($this->isUnRegistered($attendance)) {
            $this->registerAbsence($input, $userId);
        } else {
            $this->updateAbsence($attendance, $input);
        }
    }

    /**
     * @param Attendance|null $attendance
     * @return boolean
     */
    private function isUnRegistered(?Attendance $attendance): bool
    {
        return is_null($attendance);
    }

    /**
     * @param Attendance $attendance
     * @return boolean
     */
    private function isAbsence(Attendance $attendance): bool
    {
        return $attendance->absence_flg === 1;
    }

    /**
     * @param Attendance $attendance
     * @return boolean
     */
    private function isAttendance(Attendance $attendance): bool
    {
        return !is_null($attendance->start_time) && is_null($attendance->end_time);
    }

    /**
     * @param Attendance $attendance
     * @return boolean
     */
    private function isLeft(Attendance $attendance): bool
    {
        return !is_null($attendance->end_time);
    }

    /**
     * @param array $input
     * @param integer $userId
     * @return void
     */
    private function registerAbsence(array $input, int $userId): void
    {
        $this->attendance->user_id = $userId;
        $this->attendance->absence_flg = true;
        $this->attendance->fill($input)->save();
    }

    /**
     * @param Attendance $attendance
     * @param array $input
     * @return void
     */
    private function updateAbsence(Attendance $attendance, array $input): void
    {
        $attendance->absence_flg = true;
        $attendance->fill($input)->save();
    }
}
