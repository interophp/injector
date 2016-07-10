<?php

namespace InteroPhp\Injector\Context;

use InteroPhp\Injector\Exception\KeyNotFoundException;
use Interop\Container\ContainerInterface;

class InteropContainerContext extends BaseContainerContext
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
