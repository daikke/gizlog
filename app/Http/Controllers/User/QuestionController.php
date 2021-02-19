<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\TagCategory;
use Illuminate\View\View;

class QuestionController extends Controller
{
    private $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * 一覧表示
     *
     * @return View
     */
    public function index(): View
    {
        $questions = $this->question->all();
        $tagCategories = TagCategory::all();
        return view('user.question.index', compact('questions', 'tagCategories'));
    }
}
