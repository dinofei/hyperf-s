<?php

use App\Exception\ServerException;
use App\Exception\RpcErrorException;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Validation\ValidationException;
use Hyperf\Validation\ValidatorFactory;
use Psr\Container\ContainerInterface;

if (!function_exists('throws')) {
    /**
     * 抛出系统异常
     *
     * @param string $message
     * @param array $context
     * @param int|null $code
     * Author: ningfei
     * Time: 2021-01-16
     */
    function throws(string $message, array $context = [], ?int $code = null): void
    {
        throw new ServerException($message, $code, $context);
    }
}

if (!function_exists('throws_rpc')) {
    /**
     * 抛出rpc异常
     *
     * @param string $message
     * @param array $context
     * @param int|null $code
     * Author: ningfei
     * Time: 2021-01-16
     */
    function throws_rpc(string $message, array $context = [], ?int $code = null): void
    {
        throw new RpcErrorException($message, $code, $context);
    }
}

if (!function_exists('di')) {
    /**
     * 获取容器对象
     *
     * @param string|null $name
     * @return ContainerInterface|mixed
     * Author: ningfei
     * Time: 2021-01-16
     */
    function di(?string $name = null)
    {
        if (!$name) {
            return ApplicationContext::getContainer();
        }
        return ApplicationContext::getContainer()->get($name);
    }
}

if (!function_exists('rpc_validate')) {
    /**
     * rpc服务验证器
     *
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * Author: ningfei
     * Time: 2021-01-16
     */
    function rpc_validate(array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        try {
            return di(ValidatorFactory::class)->validate($data, $rules, $messages, $customAttributes);
        } catch (ValidationException $th) {
            throws_rpc($th->validator->errors()->first(), $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
