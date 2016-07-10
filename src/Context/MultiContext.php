<?php

namespace InteroPhp\Injector\Context;

use InteroPhp\Injector\Exception\KeyNotFoundException;

class MultiContext implements ContextInterface
{
    protected $contexts;
    
    public function __construct($contexts)
    {
        $this->contexts = $contexts;
    }
    
    public function has($key)
    {
        foreach ($this->contexts as $context) {
            if ($context->has($key)) {
                return true;
            }
        }
        return false;
    }
    
    public function get($key)
    {
        foreach ($this->contexts as $context) {
            if ($context->has($key)) {
                return $context->get($key);
            }
        }
        throw new KeyNotFoundException($key);
    }
}
