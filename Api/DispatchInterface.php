<?php

declare(strict_types=1);

namespace Newbury\Async\Api;

/**
 * Interface DispatchInterface
 * @package Newbury\Async\Api
 * @author Craig Newbury <craig@newbury.me>
 */
interface DispatchInterface
{
    /**
     * @param $class
     * @param $method
     * @param $params
     * @return mixed
     */
    public function dispatch($class, $method, $params);
}
