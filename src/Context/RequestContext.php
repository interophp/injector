<?php

namespace InteroPhp\Injector\Context;

use InteroPhp\Injector\Exception\KeyNotFoundException;
use Psr\Http\Message\ServerRequestInterface;

class RequestContext extends ArrayContext
{
    private $request;
    
    public function __construct(ServerRequestInterface $request)
    {
        $this->data = $request->getAttributes();
    }
}
