<?php

namespace App\Services;

/**
 * CSVを扱うサービスクラス
 */
class CsvService
{
    // CSVのカラムインデックス
    const USER_ID_INDEX = 1;
    const TITLE_INDEX = 2;
    const AUTHOR_INDEX = 3;
    const PUBLISHER_INDEX = 4;
    const PRICE_INDEX = 5;
    const PURCHASE_DATE_INDEX = 6;
    // CSVの総カラム数
    const COLUMNS_COUNT = 7;

    // SqlFileObject
    private $csv;

    // ファイルの健全性
    public $isValid = false;

    /**
     * コンストラクタ
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->csv = new \SplFileObject($path);
        $this->csv->setFlags(
            \SplFileObject::READ_CSV|
            \SplFileObject::SKIP_EMPTY|
            \SplFileObject::READ_AHEAD|
            \SplFileObject::DROP_NEW_LINE
        );
        $this->isValid = $this->validate();
    }

    /**
     * バリデーション実行
     *
     * @return boolean
     */
    private function validate(): bool
    {
        foreach ($this->csv as $row) {
            if (count($row) !== self::COLUMNS_COUNT) {
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
            $tmpBook['user_id'] = $row[self::USER_ID_INDEX];
            $tmpBook['title'] = $row[self::TITLE_INDEX];
            $tmpBook['author'] = $row[self::AUTHOR_INDEX];
            $tmpBook['publisher'] = $row[self::PUBLISHER_INDEX];
            $tmpBook['price'] = $row[self::PRICE_INDEX];
            $tmpBook['purchase_date'] = $row[self::PURCHASE_DATE_INDEX];
            $tmpBook['created_at'] = date('Y-m-d H:i:s');
            $tmpBook['updated_at'] = date('Y-m-d H:i:s');
            $books[] = $tmpBook;
        }
        return $books;
    }

}
