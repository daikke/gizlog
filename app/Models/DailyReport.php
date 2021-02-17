<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
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
     * タイトルアクセサ（30文字区切り）
     *
     * @param string $title
     * @return string
     */
    public function getTitleAttribute(string $title): string
    {
        return Str::limit($title, 30);
    }

    /**
     * コンテンツアクセサ（50文字区切り）
     *
     * @param string $contents
     * @return string
     */
    public function getContentsAttribute(string $contents): string
    {
        return Str::limit($contents, 50);
    }

    /**
     * ユーザーの日報一覧を取得
     *
     * @param integer $userId
     * @param array $params
     * @param integer $pagesize
     * @return LengthAwarePaginator
     */
    public function fetchUserReports(int $userId, array $params = [], int $pagesize = 10): LengthAwarePaginator
    {
        return $this
            ->where('user_id', $userId)
            ->when(isset($params['reporting_time']),
                function($query) use ($params) {
                    $query->whereDate('reporting_time', 'LIKE', $params['reporting_time'] . '%');
                }
            )
            ->orderBy(self::DEFAULT_ORDER, self::DEFAULT_ORDER_TYPE)
            ->paginate($pagesize);
    }
}
