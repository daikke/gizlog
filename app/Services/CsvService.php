<?php

namespace App\Services;

use \SplFileObject;
use Illuminate\Http\UploadedFile;

/**
 * CSVを扱うサービスクラス
 */
class CsvService
{
    /**
     * CSV総カラム数
     */
    const COLUMN_COUNT = 7;

    /**
     * テーブルカラム名
     */
    const COLUMN_NAMES = [
        'user_id',
        'title',
        'author',
        'publisher',
        'price',
        'purchase_date',
    ];

    /**
     * SqlFileObject
     *
     * @var SqlFileObject
     */
    private $csv;

    /**
     * CSVオリジナルファイル
     *
     * @var UploadedFile
     */
    private $file;


    /**
     * コンストラクタ
     *
     * @param UploadedFile $file
     */
    public function __construct(UploadedFile $file)
    {
        $this->csv = new SplFileObject($file->path());
        $this->csv->setFlags(
            SplFileObject::READ_CSV|
            SplFileObject::SKIP_EMPTY|
            SplFileObject::READ_AHEAD|
            SplFileObject::DROP_NEW_LINE
        );
        $this->file = $file;
    }

    /**
     * バリデーション実行
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        foreach ($this->csv as $row) {
            if (count($row) !== self::COLUMN_COUNT) {
                return false;
            }
        }
        return true;
    }

    /**
     * クライアントファイル名取得
     *
     * @return string
     */
    private function getFileName(): string
    {
        return $this->file->getClientOriginalName();
    }

    /**
     * 配列変換
     *
     * @return array
     */
    public function toArray(): array
    {
        $books = [];
        foreach ($this->csv as $index => $row) {
            // headerのため次ループへ
            if ($index === 0) {
                continue;
            }
            $tmpBook = [];
            unset($row[0]);
            $tmpBook = array_combine(self::COLUMN_NAMES, $row);
            $tmpBook['created_at'] = date('Y-m-d H:i:s');
            $tmpBook['updated_at'] = date('Y-m-d H:i:s');
            $books[] = $tmpBook;
        }
        return $books;
    }

    /**
     * CSV取り込みメッセージ
     *
     * @return string
     */
    public function getMessage(): string
    {
        if ($this->isValid()) {
            $message = '[CSV取り込み成功]ファイル名：' . $this->getFileName() . ', 件数：' . $this->getRowCount() . '件';
        } else {
            $message = '[CSV取り込み失敗]ファイル名：' . $this->getFileName() . ', 件数：' . $this->getRowCount() . '件, 内容:カラム数が欠如しているレコードが存在します';
        }
        return $message;
    }

    /**
     * CSV行数取得
     *
     * @return int
     */
    public function getRowCount(): int
    {
        $this->csv->seek(PHP_INT_MAX);
        $rowCount = $this->csv->key();
        $this->csv->seek(0);

        return $rowCount;
    }

}
