<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;


class CsvLogFormatter
{
    /**
     * ログフォーマット
     *
     * @var string
     */
    private $format = '%message%' . PHP_EOL;

    /**
     * CSVログ
     *
     * @param array $config
     * @return Logger
     */
    public function __invoke(array $config): Logger
    {
        $level = Logger::toMonologLevel($config['level']);
        $handler = new StreamHandler($config['path'], $level);
        $handler->setFormatter(new LineFormatter($this->format));
        $logger = new Logger('csv_upload');
        $logger->pushHandler($handler);
        return $logger;
    }
}