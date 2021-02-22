<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

/**
 * questionsテーブルのモデルクラス
 */
class Question extends Model
{
    /**
     * 並びカラム
     * @var string
     */
    protected $order = 'created_at';

    /**
     * 並び順
     * @var string
     */
    protected $orderType = 'desc';

    /**
     * ページネーション件数
     *
     * @var integer
     */
    protected $perPage = 10;

    /**
     * usersテーブルリレーション
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * tag_categoriesテーブルリレーション
     *
     * @return BelongsTo
     */
    public function tagCategory(): BelongsTo
    {
        return $this->belongsTo(TagCategory::class);
    }

    /**
     * commentsテーブルリレーション
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

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
     * 質問一覧取得
     *
     * @param array $params
     * @return LengthAwarePaginator
     */
    public function fetchByCondition(array $params): LengthAwarePaginator
    {
        return $this
            ->when(!empty($params['tag_category_id']),
                function($query) use ($params) {
                    $query->where('tag_category_id', $params['tag_category_id']);
                }
            )
            ->when(isset($params['search_word']) && $params['search_word'] !== '',
                function($query) use ($params) {
                    $query->where('title', 'LIKE', "%{$params['search_word']}%");
                }
            )
            ->orderBy($this->order, $this->orderBy)
            ->paginate();
    }
}
