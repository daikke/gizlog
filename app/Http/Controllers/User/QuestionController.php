<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuestionsRequest;
use App\Models\Question;
use App\Models\TagCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class QuestionController extends Controller
{
     /**
     * Questionモデル
     *
     * @var Question
     */
    private $question;

    /**
     * コンストラクタ
     *
     * @param Question $question
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
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
     * 確認画面表示
     *
     * @param QuestionsRequest $request
     * @return View
     */
    public function confirm(QuestionsRequest $request): View
    {
        $question = $request->all();
        return view('user.question.confirm', compact('question'));
    }

    /**
     * 質問作成
     *
     * @param QuestionsRequest $request
     * @return RedirectResponse
     */
    public function store(QuestionsRequest $request): RedirectResponse
    {
        $input = $request->all();
        $this->question->user_id = Auth::id();
        $this->question->fill($input)->save();
        return redirect()->route('question.mypage');
    }
}
