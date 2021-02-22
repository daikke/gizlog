<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
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
        $question = $this->question->find($id);
        return view('user.question.edit', compact('question'));
    }
}
