<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\TagCategory;
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
     * コンストラクタ
     *
     * @param Question $question
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
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
        $questions = $this->question->fetchAll($inputs);
        $tagCategories = TagCategory::all();
        return view('user.question.index', compact('questions', 'tagCategories'));
    }
}
