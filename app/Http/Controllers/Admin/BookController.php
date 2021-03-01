<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    // bookモデル
    private $book;

    /**
     * コンストラクタ
     *
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * 一覧画面表示
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.book.index');
    }
}
