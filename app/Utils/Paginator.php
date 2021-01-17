<?php

declare(strict_types=1);

namespace App\Utils;

use Hyperf\Contract\ConfigInterface;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\Context;
use Psr\Container\ContainerInterface;

/**
 * @method static string getPerPageName()
 * @method static int getPerPage()
 * @method static string getCurrentName()
 * @method static int getCurrent()
 * @method static string getTotalName()
 * @method static string getLastPageName()
 * Author: ningfei
 * Time: 2021-01-17
 */
class Paginator
{
    /**
     * @var 分页器配置
     */
    protected $values;

    public function __construct(ContainerInterface $container)
    {
        $this->values = $container->get(ConfigInterface::class)->get('paginator');
        $request = $container->get(RequestInterface::class);
        $this->setValue('perPage',  (int)$request->input($this->values['perPageName'], $this->values['defaultPerPage']));
        $this->setValue('current',  (int)$request->input($this->values['currentName'], $this->values['defaultCurrent']));
    }

    /**
     * @param string $name
     * Author: ningfei
     * Time: 2021-01-17
     */
    protected function getValue(string $name)
    {
        return $this->values[$name] ?? null;
    }

    /**
     * @param string $name
     * @param string|int $value
     * @return Paginator
     * Author: ningfei
     * Time: 2021-01-17
     */
    protected function setValue(string $name, $value): Paginator
    {
        $this->values[$name] = $value;
        return $this;
    }

    public static function factory()
    {
        return Context::getOrSet(static::class, function () {
            return di()->make(static::class);
        });
    }

    public static function __callStatic($method, $params)
    {
        $prefix = substr($method, 0, 3);
        $name = substr($method, 3);
        if ($prefix === false || $name === false) {
            return null;
        }
        $newMethod = strtolower($prefix) . 'Value';
        $stance = static::factory();
        if (method_exists($stance, $newMethod)) {
            return call_user_func([$stance, $newMethod], lcfirst($name), ...$params);
        }
        return null;
    }
}
