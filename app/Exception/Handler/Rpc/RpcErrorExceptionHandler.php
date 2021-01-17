<?php

declare(strict_types=1);

namespace App\Exception\Handler\Rpc;

use App\Exception\RpcErrorException;
use App\Utils\Log;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Psr\Http\Message\ResponseInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Throwable;

/**
 * rpc异常处理器
 *
 * Author: ningfei
 * Time: 2021-01-16
 */
class RpcErrorExceptionHandler extends ExceptionHandler
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
        $this->stopPropagation();
        $message = sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile());
        if (env('APP_ENV') === 'dev') {
            $this->logger->error($message);
            $this->logger->error($throwable->getTraceAsString());
        } else {
            Log::get(env('APP_NAME'), 'server')->error($message, $throwable->getContext());
        }
        return $response;
    }

    public function isValid(Throwable $throable): bool
    {
        return $throable instanceof RpcErrorException;
    }
}
