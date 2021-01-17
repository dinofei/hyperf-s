<?php

declare(strict_types=1);

namespace App\Resource;

trait ToResultTrait
{
    public function toResult(): array
    {
        return (new Response($this))->toResponse();
    }
}
