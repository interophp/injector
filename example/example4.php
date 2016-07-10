<?php

namespace InteroPhp\Injector\Test;

// Require the Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

use InteroPhp\Injector\Context\InteropContainerContext;
use InteroPhp\Injector\Injector;
use Acclimate\Container\ArrayContainer;

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


$data = [
    'greeting' => 'Aloha',
    'color' => 'red',
    'test.name' => 'Joe',
    'other' => 'stuff'
];

// A simple in-memory container, implementing the standard ContainerInterface
$container = new ArrayContainer($data);

$containerContext = new InteropContainerContext($container);

$injector = new Injector();

$greeter = $injector->instantiate(Greeter::class, $containerContext);
$res = $injector->callMethod($greeter, 'greet', $containerContext);

echo $res . PHP_EOL;
