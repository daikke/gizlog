<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps = false;

    public function fetchRelatedModifyRequests(ModifyRequest $modifyRequests): Collection
    {
        return $modifyRequests
            ->where('user_id', $this->user_id)
            ->where('registration_date', $this->registration_date)
            ->get();
    }
}
