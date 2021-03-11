<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        return $this->belongsTo(User::class);
    }

    /**
     * tag_categoriesテーブルリレーション
     *
     * @return belongsToMany
     */
    public function tagCategories(): BelongsToMany
    {
        return $this->belongsToMany(TagCategory::class);
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
                    $query
                        ->join('question_tag_category', 'questions.id', 'question_tag_category.question_id')
                        ->where('question_tag_category.tag_category_id', $params['tag_category_id']);
                }
            )
            ->when(isset($params['search_word']) && $params['search_word'] !== '',
                function($query) use ($params) {
                    $query->where('title', 'LIKE', '%' . $params['search_word'] . '%');
                }
            )
            ->orderBy($this->order, $this->orderBy)
            ->paginate();
    }

    /**
     * 作成処理
     *
     * @param array $inputs
     * @return void
     */
    public function registerWithRelation(array $inputs): void
    {
        DB::transaction(function () use ($inputs) {
            $this->fill($inputs)->save();
            $this->tagCategories()->sync($inputs['tag_category_ids']);
        });
    }

    /**
     * 更新処理
     *
     * @param integer $id
     * @param array $inputs
     * @return void
     */
    public function updateWithRelation(int $id, array $inputs): void
    {
        DB::transaction(function () use ($id, $inputs) {
            $this->find($id)->fill($inputs)->save();
            $this->find($id)->tagCategories()->sync($inputs['tag_category_ids']);
        });
    }
}
