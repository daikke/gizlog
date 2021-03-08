<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * daily_reportsテーブルのModelクラス
 */
class DailyReport extends Model
{
    use SoftDeletes;

    /**
     * 複数代入ホワイトリスト
     *
     * @var array
     */
    protected $fillable = [
        'reporting_time',
        'title',
        'contents',
    ];

    /**
     * 日付ミューテタ
     *
     * @var array
     */
    protected $dates = [
        'reporting_time',
        'deleted_at',
    ];

    /**
     * ページネーション件数
     *
     * @var integer
     */
    protected $perPage = 10;

    /**
     * タイトルアクセサ
     *
     * @param string $title
     * @return string
     */
    public function getTitleAttribute(string $title): string
    {
        return Str::limit($title, 30);
    }

    /**
     * コンテンツアクセサ
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
    public function fetchByUserId(int $userId, array $params = [], int $pagesize = Null): LengthAwarePaginator
    {
        return $this
            ->where('user_id', $userId)
            ->when(isset($params['reporting_time']),
                function($query) use ($params) {
                    $reportingTime = new Carbon($params['reporting_time']);
                    $query->whereBetween(
                        'reporting_time',
                        [
                            $reportingTime->firstOfMonth()->format('Y-m-d H:i:s'),
                            $reportingTime->lastOfMonth()->format('Y-m-d H:i:s')
                        ]
                    );
                }
            )
            ->orderBy('reporting_time', 'desc')
            ->paginate($pagesize);
    }
}
