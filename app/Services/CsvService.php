<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

/**
 * CSVを扱うサービスクラス
 */
class CsvService
{
    /**
     * CSVカラムインデックス
     *
     * @var integer
     */
    private $userIdIndex = 1;
    private $titleIndex = 2;
    private $authorIndex = 3;
    private $publisherIndex = 4;
    private $priceIndex = 5;
    private $purchaseDateIndex = 6;

    /**
     * CSV総カラム数
     *
     * @var integer
     */
    private $columnCount = 7;

    /**
     * SqlFileObject
     *
     * @var SqlFileObject
     */
    private $csv;

    /**
     * ファイルのバリデーション結果
     *
     * @var boolean
     */
    private $isValid = false;

    /**
     * CSV行数
     *
     * @var integer
     */
    private $rowCount = 0;

    /**
     * CSVオリジナルファイル名
     *
     * @var string
     */
    private $fileName = '';


    /**
     * コンストラクタ
     *
     * @param UploadedFile $file
     */
    public function __construct(UploadedFile $file)
    {
        $this->csv = new \SplFileObject($file->path());
        $this->csv->setFlags(
            \SplFileObject::READ_CSV|
            \SplFileObject::SKIP_EMPTY|
            \SplFileObject::READ_AHEAD|
            \SplFileObject::DROP_NEW_LINE
        );
        $this->isValid = $this->validate();
        $this->fileName = $file->getClientOriginalName();
        $this->csv->seek(PHP_INT_MAX);
        $this->rowCount = $this->csv->key();
        $this->csv->seek(0);
    }

    /**
     * バリデーション実行
     *
     * @return boolean
     */
    private function validate(): bool
    {
        foreach ($this->csv as $row) {
            if (count($row) !== $this->columnCount) {
                return false;
            }
        }
        return true;
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
            if ($index === 0) {
                continue;
            }
            $tmpBook = [];
            $tmpBook['user_id'] = $row[$this->userIdIndex];
            $tmpBook['title'] = $row[$this->titleIndex];
            $tmpBook['author'] = $row[$this->authorIndex];
            $tmpBook['publisher'] = $row[$this->publisherIndex];
            $tmpBook['price'] = $row[$this->priceIndex];
            $tmpBook['purchase_date'] = $row[$this->purchaseDateIndex];
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
        if ($this->isValid) {
            $message = '[CSV取り込み成功]ファイル名：' . $this->fileName . ', 件数：' . $this->rowCount . '件';
        } else {
            $message = '[CSV取り込み失敗]ファイル名：' . $this->fileName . ', 件数：' . $this->rowCount . '件, 内容:カラム数が欠如しているレコードが存在します';
        }
        return $message;
    }

    /**
     * CSVバリデーション結果取得
     *
     * @return boolean
     */
    public function getIsValid(): bool
    {
        return $this->isValid;
    }

    /**
     * CSV行数取得
     *
     * @return int
     */
    public function getRowCount(): int
    {
        return $this->rowCount;
    }

}
