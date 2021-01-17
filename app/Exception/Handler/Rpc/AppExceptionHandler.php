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

namespace App\Exception\Handler\Rpc;

use App\Utils\Log;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * 兜底异常处理
 *
 * Author: ningfei
 * Time: 2021-01-16
 */
class AppExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        if ($throwable instanceof ValidationException) {
            $message = $throwable->validator->errors()->first();
        } else {
            $message = sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile());
        }
        if (env('APP_ENV') === 'dev') {
            $this->logger->error($message);
            $this->logger->error($throwable->getTraceAsString());
        } else {
            Log::get(env('APP_NAME'), 'server')->error($message, [
                'request_id' => di()->get(RequestInterface::class)->getAttribute('request_id'),
                'app_name' => env('APP_NAME'),
                'meta' => di()->get(RequestInterface::class)->all(),
            ]);
        }
        return $response;
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
