<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
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
     * 日報取得(ページング)
     *
     * @param Array $params
     * @param integer $pagesize
     * @return LengthAwarePaginator
     */
    public function fetchReports(Array $params, int $pagesize = 10): LengthAwarePaginator
    {
        $builder = $this
            ->when(isset($params['user_id']), function($query) use ($params) {
                $query->where('user_id', $params['user_id']);
            });
        return $builder->paginate($pagesize);
    }
}
