<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookCsvRequest;
use App\Models\Book;
use App\Services\CsvService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Bookモデルインスタンス
     *
     * @var Book
     */
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
        $books = $this->book->fetchBooks();
        return view('admin.book.index', compact('books'));
    }

    /**
     * CSVからインポート
     *
     * @param BookCsvRequest $request
     * @return RedirectResponse
     */
    public function upload(BookCsvRequest $request): RedirectResponse
    {
        $csvService = new CsvService($request->file('csv'));
        Log::channel('csv_upload')->info($csvService->getMessage());

        if ($csvService->isValid()) {
            $this->book->insert($csvService->toArray());
            return redirect()->route('admin.book.index')->with('message', $csvService->getRowCount() . '件登録しました。');
        }

        return redirect()->route('admin.book.index')->with('message', '登録に失敗しました。');
    }
}
