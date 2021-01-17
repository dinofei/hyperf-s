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

namespace App\Model;

use Hyperf\DbConnection\Model\Model as BaseModel;
use Hyperf\ModelCache\Cacheable;
use Hyperf\ModelCache\CacheableInterface;

abstract class Model extends BaseModel implements CacheableInterface
{
    use Cacheable;

    /**
     * 存入时使用int字段代替时间戳字段
     * @param mixed $value
     * @return int|string|null
     * Author: nf
     * Time: 2020/10/28 10:53
     */
    public function fromDateTime($value)
    {
        return empty($value) ? 0 : $this->asDateTime($value)->getTimestamp();
    }

    /**
     * 取出时时间戳转换为日期
     * @return string|null
     * Author: nf
     * Time: 2020/10/28 10:53
     */
    public function freshTimestampString(): ?string
    {
        return (string) $this->fromDateTime($this->freshTimestamp());
    }
}
