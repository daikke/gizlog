<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class DailyReport extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'reporting_time',
        'title',
        'contents',
    ];

    protected $dates = [
        'reporting_time',
        'deleted_at',
    ];

    /**
     * 日報取得
     *
     * @param Array $params
     * @return Collection
     */
    public function fetchReports(Array $params): Collection
    {
        $builder = $this
            ->when(isset($params['user_id']), function($query) use ($params) {
                $query->where('user_id', $params['user_id']);
            });
        return $builder->get();
    }
}
