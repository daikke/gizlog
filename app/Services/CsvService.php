<?php

namespace App\Services;

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
     * ファイルの健全性
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
    private $name = '';


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

}
