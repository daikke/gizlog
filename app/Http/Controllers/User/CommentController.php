<?php

namespace App\Http\Controllers\User;

use App\Models\Comment;
use App\Http\Controllers\Controller;
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


    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        $this->comment->user_id = Auth::id();
        $this->comment->fill($input)->save();
        return redirect()->route('question.index');
    }
}
