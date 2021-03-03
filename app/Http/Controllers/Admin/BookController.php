<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookCsvRequest;
use App\Models\Book;
use App\Services\CsvService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    // デフォルト並び順
    const DEFAULT_ORDER = 'created_at';
    const DEFAULT_ORDER_TYPE = 'desc';

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
        $books = $this->book->orderBy(self::DEFAULT_ORDER, self::DEFAULT_ORDER_TYPE)->paginate();
        return view('admin.book.index', compact('books'));
    }

    /**
     * CSVからインポート
     *
     * @param BookCsvRequest $request
     * @return RedirectResponse
     */
    public function csvBulkStore(BookCsvRequest $request):RedirectResponse
    {
        $csvService = new CsvService($request->file('csv'));
        $this->book->insert($csvService->toArray());
        return redirect()->route('admin.book.index');
    }
}
