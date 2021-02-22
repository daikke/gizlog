<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;

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

   public function mypage()
   {
       return view('user.question.mypage');
   }
}