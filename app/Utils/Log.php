<?php

declare(strict_types=1);

namespace App\Utils;

use Hyperf\Logger\Logger;
use Hyperf\Logger\LoggerFactory;

class Log
{
    /**
     * 日志工具
     *
     * @param string $name
     * @param string $channel
     * @return Logger 
     * Author: ningfei
     * Time: 2021-01-16
     */
    public static function get(string $name = 'app', string $channel = 'default')
    {
        return di()->get(LoggerFactory::class)->get($name, $channel);
    }
}
