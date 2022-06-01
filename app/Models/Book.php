<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * booksテーブルモデルクラス
 */
class Book extends Model
{
    use SoftDeletes;

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
     * priceアクセサ
     *
     * @param integer $price
     * @return string
     */
    public function getPriceAttribute(int $price):string
    {
        return number_format($price);
    }

    /**
     * ページサイズ
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
}
