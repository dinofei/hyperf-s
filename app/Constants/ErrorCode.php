<?php

declare(strict_types=1);

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 * 
 * @method static string getMessage($code)
 */
class ErrorCode extends AbstractConstants
{
    /**
     * @Message("服务器内部错误") 
     */
    const SERVER_ERROR = 'goods.server_error';
    /**
     * @Message("商品不存在")
     */
    const GOODS_NO_EXISTS = 'goods.goods_no_exists';
}
