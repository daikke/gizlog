<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModifyRequest extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'registration_date',
        'reason',
    ];

}
