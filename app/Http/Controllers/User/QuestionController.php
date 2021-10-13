<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuestionsRequest;
use App\Http\Requests\User\CommentRequest;
use App\Models\Comment;
use App\Models\Question;
use App\Models\TagCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * 質問を扱うコントローラークラス
 */
class QuestionController extends Controller
{
    /**
     * Questionモデル
     *
     * @var Question
     */
    private $question;

    /**
     * Commentモデル
     *
     * @var Comment
     */
    private $comment;

    /**
     * TagCategoryモデル
     *
     * @var TagCategory
     */
    private $tagCategory;

    /**
     * コンストラクタ
     *
     * @param Question $question
     */
    public function __construct(Question $question, TagCategory $tagCategory, Comment $comment)
    {
        $this->question = $question;
        $this->tagCategory = $tagCategory;
        $this->comment = $comment;
    }

    /**
     * 一覧表示
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $inputs = $request->all();
        $questions = $this->question->fetchByCondition($inputs);
        $tagCategories = $this->tagCategory->all();
        return view('user.question.index', compact('questions', 'tagCategories'));
    }

    /**
     * 編集画面表示
     *
     * @param integer $id
     * @return View
     */
    public function edit(int $id): View
    {
        $tagCategories = TagCategory::pluck('name', 'id');
        $question = $this->question->find($id);
        return view('user.question.edit', compact('question', 'tagCategories'));
    }

    /**
     * 詳細表示
     *
     * @param integer $id
     * @return View
     */
    public function show(int $id): View
    {
        $question = $this->question->find($id);
        return view('user.question.show', compact('question'));
    }

    /**
     * 作成画面
     *
     * @return View
     */
    public function create(): View
    {
        $tagCategories = TagCategory::pluck('name', 'id');
        return view('user.question.create', compact('tagCategories'));
    }

    /**
     * 確認画面表示
     *
     * @param QuestionsRequest $request
     * @return View
     */
    public function confirm(QuestionsRequest $request, $id = null): View
    {
        $request->id = $id;
        return view('user.question.confirm', compact('request'));
    }

    /**
     * 更新処理
     *
     * @param integer $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        $inputs = $request->all();
        $this->question->updateWithTagCategories($id, $inputs);
        return redirect()->route('question.mypage');
    }

    /**
     * 質問作成
     *
     * @param QuestionsRequest $request
     * @return RedirectResponse
     */
    public function store(QuestionsRequest $request): RedirectResponse
    {
        $inputs = $request->all();
        $this->question->user_id = Auth::id();
        $this->question->registerWithTagCategories($inputs);
        return redirect()->route('question.mypage');
    }

    /*
     * コメント登録
     *
     * @param integer $questionId
     * @param CommentRequest $request
     * @return RedirectResponse
     */
    public function commentStore(int $questionId, CommentRequest $request): RedirectResponse
    {
        $input = $request->all();
        $this->comment->user_id = Auth::id();
        $this->comment->question_id = $questionId;
        $this->comment->fill($input)->save();
        return redirect()->route('question.index');
    }

    /**
     * マイページ表示
     *
     * @return View
     */
    public function mypage(): View
    {
        $questions = $this->question->fetchByUserId(Auth::id());
        return view('user.question.mypage', compact('questions'));
    }

    /**
     * 削除
     *
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->question->find($id)->delete();
        return redirect()->route('question.mypage');
    }

    /**
     * 質問数の多いユーザーランキング
     *
     * @return View
     */
    public function userRanking(): View
    {
        $rankings = $this->question->fetchUserQuestionsCountsSummary();
        return view('user.question.ranking.question', compact('rankings'));
    }

    /**
     * 質問数の多いタグカテゴリーランキング
     *
     * @return View
     */
    public function tagCategoryRanking(): View
    {
        return view('user.question.ranking.tag');
    }

    /**
     * コメント数の多いユーザーランキング
     *
     * @return View
     */
    public function commentUserRanking(): View
    {
        $rankings = $this->comment->fetchUserCommentsCountsSummary();
        return view('user.question.ranking.comment', compact('rankings'));
    }
}
