<?php

namespace App\Resource;

use Hyperf\Resource\Json\ResourceCollection;

/**
 * 列表集合资源
 *
 * Author: ningfei
 * Time: 2021-01-17
 */
class Lists extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->collection->toArray();
    }
}
