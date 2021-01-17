<?php

namespace App\Resource;

use App\Utils\Paginator;
use Hyperf\Resource\Json\ResourceCollection;

/**
 * 分页集合资源
 *
 * Author: ningfei
 * Time: 2021-01-17
 */
class Page extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'data' => $this->collection,
            'meta' => [
                Paginator::getCurrentName() => $this->resource->currentPage(),
                Paginator::getPerPageName() => $this->resource->perPage(),
                Paginator::getTotalName() => $this->resource->total(),
                Paginator::getLastPageName() => $this->resource->lastPage(),
            ]
        ];
    }
}
