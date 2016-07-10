<?php

namespace InteroPhp\Injector\Test;

// Require the Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

use InteroPhp\Injector\Context\ArrayContext;
use InteroPhp\Injector\Context\RequestContext;
use InteroPhp\Injector\Context\MultiContext;
use InteroPhp\Injector\Injector;

class Greeter
{
    private $greeting = 'Hello';
    
    public function __construct($greeting)
    {
        $this->greeting = $greeting;
    }
    
    public function greet($test__name)
    {
        return $this->greeting . ', ' . $test__name;
    }
}


$request = (new \Zend\Diactoros\ServerRequest())
    ->withUri(new \Zend\Diactoros\Uri('http://example.com'))
    ->withMethod('GET')
    ->withAttribute('greeting', 'Hi');

$requestContext = new RequestContext($request);

$data = [
    'color' => 'red',
    'test.name' => 'Joe',
    'other' => 'stuff'
];

$arrayContext = new ArrayContext($data);

$multiContext = new MultiContext([$requestContext, $arrayContext]);

$injector = new Injector();

$greeter = $injector->instantiate(Greeter::class, $multiContext);
$res = $injector->callMethod($greeter, 'greet', $multiContext);

echo $res . PHP_EOL;
