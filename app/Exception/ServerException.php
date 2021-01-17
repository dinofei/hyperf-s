<?php

declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

/**
 * 服务端系统异常
 *
 * Author: ningfei
 * Time: 2021-01-16
 */
class ServerException extends RuntimeException
{
    /**
     * @var int
     */
    protected $code;
    /**
     * @var string
     */
    protected $message;
    /**
     * @var array
     */
    protected $context;

    public function __construct(?string $message = null, ?int $code = null, array $context = [])
    {
        $this->code = $code ?? $this->getDefaultCode();
        $this->message = $message ?? $this->getDefaultMessage();
        $this->context = $context;
    }

    protected function getDefaultMessage()
    {
        return 'Unkonw Server Error.';
    }

    protected function getDefaultCode()
    {
        return 500;
    }

    public function getContext()
    {
        return $this->context;
    }
}
