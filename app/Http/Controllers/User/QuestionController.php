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
        $tagCategories->prepend('Select category', '');
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
        $this->question->find($id)->fill($request->all())->save();
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
        $this->question->fill($inputs)->save();
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
}
