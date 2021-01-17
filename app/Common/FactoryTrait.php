<?php

declare(strict_types=1);

namespace App\Common;

trait FactoryTrait
{
    /**
     * 工厂函数
     * @return static
     * Author: ningfei
     * Time: 2021-01-17
     */
    public static function factory()
    {
        return di()->get(static::class);
    }
}
