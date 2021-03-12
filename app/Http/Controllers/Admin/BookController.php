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
        $books = $this->book->orderBy('created_at', 'desc')->paginate();
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
        if ($csvService->getIsValid()) {
            $this->book->insert($csvService->toArray());
            $message = $csvService->getRowCount() . '件登録しました。';
        } else {
            $message = '登録に失敗しました。';
        }
        Log::channel('csv_upload')->info($csvService->getMessage());
        return redirect()->route('admin.book.index')->with('message', $message);
    }
}
