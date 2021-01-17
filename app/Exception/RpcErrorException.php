<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constants\ErrorCode;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Rpc\Context;

/**
 * rpc异常类
 *
 * Author: ningfei
 * Time: 2021-01-16
 */
class RpcErrorException extends ServerException
{

    public function __construct(?string $message = null, ?int $code = null, array $context = [])
    {
        if (is_null(ErrorCode::getMessage($this->code))) {
            $this->message = '未定义的rpc异常错误码';
        }
        $contextInstance = di()->get(Context::class);
        $contextInstance->set('request_id', di()->get(RequestInterface::class)->getAttribute('request_id'));
        $contextInstance->set('app_name', env('APP_NAME'));
        $contextInstance->set('error_text', ErrorCode::getMessage($message) ?? $message);
        $contextInstance->set('meta', $context);
        parent::__construct($message, $code, $contextInstance->getData());
    }

    protected function getDefaultCode()
    {
        return 400;
    }
}
