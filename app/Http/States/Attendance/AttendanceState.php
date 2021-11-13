<?php

namespace App\Http\States\Attendance;

class AttendanceState implements StateInterface
{

    private $state = 'attendance';

    public function getStatus(): string
    {
        return $this->state;
    }

    public function storeAttendance(): void
    {
        
    }
}
