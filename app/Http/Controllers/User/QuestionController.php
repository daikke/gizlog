<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
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
    * コンストラクタ
    *
    * @param Question $question
    */
   public function __construct(Question $question)
   {
       $this->question = $question;
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
}