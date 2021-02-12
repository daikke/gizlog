<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
class DailyReport extends Model
{
    use SoftDeletes;

    const DEFAULT_ORDER = 'reporting_time';
    const DEFAULT_ORDER_TYPE = 'desc';

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
            ->when(isset($params['user_id']),
                function($query) use ($params) {
                    $query->where('user_id', $params['user_id']);
                }
            )
            ->when(isset($params['order']) && isset($params['order_type']),
                function($query) use ($params) {
                    $query->orderBy($params['order'], $params['order_type']);
                },
                function($query) {
                    $query->orderBy(self::DEFAULT_ORDER, self::DEFAULT_ORDER_TYPE);
                }
            );
        return $builder->paginate($pagesize);
    }
}
