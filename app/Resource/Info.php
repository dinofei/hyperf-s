<?php

namespace App\Resource;

use App\Common\FactoryTrait;
use Hyperf\Resource\Json\JsonResource;

/**
 * 单个资源
 *
 * Author: ningfei
 * Time: 2021-01-17
 */
class Info extends JsonResource
{
    use ToResultTrait, FactoryTrait;

    public $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return parent::toArray();
    }
}
