<?php

namespace App\Http\States\Attendance;

class LeftState implements StateInterface
{

    private $state = 'left';

    public function getStatus(): string
    {
        return $this->state;
    }

    public function storeAttendance(): void
    {
        
    }
}
