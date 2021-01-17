<?php

declare(strict_types=1);

namespace App\Common;

trait FactoryTrait
{
    /**
     * 单例工厂方法
     * @return static
     * Author: ningfei
     * Time: 2021-01-17
     */
    public static function factory()
    {
        return di()->get(static::class);
    }

    /**
     * 新建实例工厂方法
     * @return static
     * Author: ningfei
     * Time: 2021-01-18
     */
    public static function new()
    {
        return new static(...func_get_args());
    }
}
