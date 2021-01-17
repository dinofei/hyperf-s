<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use Psr\Log\LogLevel;
use Hyperf\Contract\StdoutLoggerInterface;

return [
    'app_name' => env('APP_NAME', 'skeleton'),
    'app_env' => env('APP_ENV', 'dev'),
    'scan_cacheable' => env('SCAN_CACHEABLE', false),
    StdoutLoggerInterface::class => [
        'log_level' => [
            // LogLevel::ALERT,
            // LogLevel::CRITICAL,
            // LogLevel::DEBUG,
            // LogLevel::EMERGENCY,
            LogLevel::ERROR,
            LogLevel::INFO,
            // LogLevel::NOTICE,
            // LogLevel::WARNING,
        ],
    ],
    // 分页器配置
    'paginator' => [
        'perPageName' => 'per_page',
        'totalName' => 'total',
        'lastPageName' => 'last_page',
        'currentName' => 'page',
        'defaultPerPage' => 20,
        'defaultTotal' => 0,
        'defaultLastPage' => 1,
        'defaultCurrent' => 1,
    ]
];
