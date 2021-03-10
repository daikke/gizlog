<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CommentRequest;
use App\Models\Comment;
use App\Models\Question;
use App\Models\TagCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class QuestionController extends Controller
{
    private $question;
    private $comment;

    public function __construct(Question $question, Comment $comment)
    {
        $this->question = $question;
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

    /**
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
