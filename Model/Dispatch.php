<?php

declare(strict_types=1);

namespace Newbury\Async\Model;

use Newbury\Async\Api\DispatchInterface;

/**
 * Class Dispatch
 * @package Newbury\Async\Model
 * @author Craig Newbury <craig@newbury.me>
 */
class Dispatch implements DispatchInterface
{
    public function dispatch($class, $method, $params = null)
    {
        if (!class_exists($class)) {
            throw new \InvalidArgumentException(__('Non-existant class passed as argument'));
        }
        if (is_array($params)) {
            $params = implode(' ', $params);
        }
        $params = escapeshellarg($params);
        $command = "php ../bin/magento newbury:async:runner $class $method $params &";
        $pwd = exec('pwd');
        $response = exec($command);
    }
}