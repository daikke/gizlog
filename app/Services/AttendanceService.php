<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

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

        if ($attendance->isAbsence($attendance)) {
            return self::ABSENCE;
        }

        if ($attendance->isAttendance($attendance)) {
            return self::ATTENDANCE;
        }

        if ($attendance->isLeft($attendance)) {
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
     * @param integer $userId
     * @return Collection
     */
    public function fetchAttendancesByUserId(int $userId): Collection
    {
        return $this->attendance->fetchAttendancesByUserId($userId);
    }

    /**
     * @param integer $userId
     * @return integer
     */
    public function countAttendancesByUserId(int $userId): int
    {
        return $this->attendance->countAttendancesByUserId($userId);
    }

    /**
     * @param integer $userId
     * @return string
     */
    public function aggregateAttendancesTimeByUserId(int $userId): string
    {
        return $this->attendance->aggregateAttendancesTimeByUserId($userId);
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
