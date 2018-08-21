<?php
namespace App\Services;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Processor\MemoryUsageProcessor;

class LoggerFactory
{
    private function __construct(){}

    public static function get($channel='app', $format='Y-m', $max = 3, $level = Logger::DEBUG)
    {
        $rotating = new RotatingFileHandler(storage_path("logs/{$channel}/file.log") , $max, $level, true, 0664 );
        $rotating->setFilenameFormat('{date}_'.$channel, $format);
        $rotating->setFormatter(new LineFormatter(null, null, true, true) );
        $rotating->pushProcessor(new MemoryUsageProcessor());

        $handlers = array($rotating);
        return new Logger($channel, $handlers);
    }
}
