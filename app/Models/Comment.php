<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * commentsテーブルのモデルクラス
 */
class Comment extends Model
{
    use SoftDeletes;

    /**
     * ランキングページでの表示件数
     *
     * @var integer
     */
    protected $rankingPerPage = 20;

    protected $fillable = [
        'title',
        'content',
    ];

    /**
     * usersテーブルリレーション
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * ユーザーごとのコメント数ランキング取得
     *
     * @return Collection
     */
    public function fetchUserCommentsCountsRankings(): Collection
    {
        $selectColumns = [
            'user_id',
            'COUNT(*) AS comments_count',
        ];

        return $this
            ->select(DB::raw(implode(',', $selectColumns)))
            ->groupBy('user_id')
            ->orderByDesc('comments_count')
            ->get();
    }

    /**
     * ユーザーごとのコメント数ランキングをサマリーから取得
     *
     * @return LengthAwarePaginator
     */
    public function fetchUserCommentsCountsSummary(): LengthAwarePaginator
    {
        return DB::table('summary_user_comments_counts_rankings')
            ->join('users', 'summary_user_comments_counts_rankings.user_id', '=', 'users.id')
            ->orderBy('rank')
            ->paginate($this->rankingPerPage);
    }
}
