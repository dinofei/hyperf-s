<?php

declare(strict_types=1);

use App\Exception\Handler\Rpc\AppExceptionHandler;
use App\Exception\Handler\Rpc\RpcErrorExceptionHandler;

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'handler' => [
        'http' => [
            Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler::class,
            App\Exception\Handler\Http\AppExceptionHandler::class,
        ],
        'jsonrpc-http' => [
            RpcErrorExceptionHandler::class,
            AppExceptionHandler::class,
        ]
    ],
];
