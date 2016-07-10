<?php

namespace InteroPhp\Injector\Context;

interface ContextInterface
{
    public function has($key);
    public function get($key);
}
