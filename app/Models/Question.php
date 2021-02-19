<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
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
}
