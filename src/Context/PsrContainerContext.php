<?php

namespace InteroPhp\Injector\Context;

use InteroPhp\Injector\Exception\KeyNotFoundException;
use Psr\Container\ContainerInterface;

class PsrContainerContext extends BaseContainerContext
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
