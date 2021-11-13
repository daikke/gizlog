<?php

namespace App\Http\States\Attendance;

interface StateInterface
{
    public function getStatus(): string;

    public function storeAttendance(): void;
}
