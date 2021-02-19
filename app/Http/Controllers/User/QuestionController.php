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
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $input = $request->all();
        $questions = $this->question->fetchAll($input);
        $tagCategories = TagCategory::all();
        return view('user.question.index', compact('questions', 'tagCategories'));
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
}
