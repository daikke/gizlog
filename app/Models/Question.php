<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class Question extends Model
{
    const DEFAULT_ORDER = 'created_at';
    const DEFAULT_ORDER_TYPE = 'desc';

    protected $perPage = 10;
    protected $fillable = [
        'content',
        'title',
        'tag_category_id',
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
     * 質問一覧取得
     *
     * @param array $params
     * @param integer $pagesize
     * @return LengthAwarePaginator
     */
    public function fetchAll(array $params, int $pagesize = NULL): LengthAwarePaginator
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
            ->orderBy(self::DEFAULT_ORDER, self::DEFAULT_ORDER_TYPE)
            ->paginate($pagesize);
    }
}
