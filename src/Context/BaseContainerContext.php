<?php

namespace InteroPhp\Injector\Context;

use InteroPhp\Injector\Exception\KeyNotFoundException;

abstract class BaseContainerContext implements ContextInterface
{
    protected $container;
    
    public function __construct($container)
    {
        $this->container = $container;
    }
    
    public function has($key)
    {
        return $this->container->has($key);
    }
    
    public function get($key)
    {
        if (!$this->has($key)) {
            throw new KeyNotFoundException($key);
        }
        return $this->container->get($key);
    }
}
