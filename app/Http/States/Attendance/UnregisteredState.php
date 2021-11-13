<?php

namespace App\Http\States\Attendance;

class UnregisteredState implements StateInterface
{

    private $state = 'unregistered';

    public function getStatus(): string
    {
        return $this->state;
    }

    public function storeAttendance(): void
    {
        
    }
}
