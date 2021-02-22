<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

/**
 * questionsテーブルのモデルクラス
 */
class Question extends Model
{
    use SoftDeletes;

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
     * 複数代入ホワイトリスト
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'title',
        'tag_category_id',
    ];

    /**
     * 日付ミューテタ
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
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
     * tag_categoriesテーブルリレーション
     *
     * @return BelongsTo
     */
    public function tagCategory(): BelongsTo
    {
        return $this->belongsTo('App\Models\TagCategory');
    }

    /**
     * commentsテーブルリレーション
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany('App\Models\Comment');
    }

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
     * ユーザーの質問取得
     *
     * @param integer $userId
     * @return LengthAwarePaginator
     */
    public function fetchByUserId(int $userId): LengthAwarePaginator
    {
        return $this
            ->where('user_id', $userId)
            ->orderBy($this->order, $this->orderType)
            ->paginate();
    }
}