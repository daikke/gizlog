<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;

class Question extends Model
{
    const DEFAULT_ORDER = 'created_at';
    const DEFAULT_ORDER_TYPE = 'desc';

    protected $perPage = 10;

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
            ->orderBy(self::DEFAULT_ORDER, self::DEFAULT_ORDER_TYPE)
            ->paginate($pagesize);
    }
}
