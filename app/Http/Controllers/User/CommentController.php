<?php

namespace App\Http\Controllers\User;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CommentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * コメント保存
     *
     * @param CommentRequest $request
     * @return RedirectResponse
     */
    public function store(CommentRequest $request): RedirectResponse
    {
        $input = $request->all();
        $this->comment->user_id = Auth::id();
        $this->comment->fill($input)->save();
        return redirect()->route('question.index');
    }
}
