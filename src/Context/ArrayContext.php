<?php

namespace InteroPhp\Injector\Context;

use InteroPhp\Injector\Exception\KeyNotFoundException;

class ArrayContext implements ContextInterface
{
    protected $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function has($key)
    {
        return isset($this->data[$key]);
    }
    
    public function get($key)
    {
        if (!$this->has($key)) {
            throw new KeyNotFoundException($key);
        }
        return $this->data[$key];
    }
}
