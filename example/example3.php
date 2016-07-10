<?php

namespace InteroPhp\Injector\Test;

// Require the Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

use InteroPhp\Injector\Context\ArrayContext;
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

class LoudGreeter
{
    private $greeter;
    
    public function __construct(Greeter $greeter)
    {
        $this->greeter = $greeter;
    }
    
    public function greet($test__name)
    {
        return strtoupper($this->greeter->greet($test__name)) . "!!!";
    }
}

$injector = new Injector();

$data = [
    'color' => 'red',
    'test.name' => 'Joe',
    'other' => 'stuff',
    'greeting' => 'Hi'
];
$arrayContext = new ArrayContext($data);

$greeter = $injector->instantiate(Greeter::class, $arrayContext);

$data['InteroPhp\Injector\Test\Greeter'] = $greeter;
$arrayContext = new ArrayContext($data);
$loudGreeter = $injector->instantiate(LoudGreeter::class, $arrayContext);

$res = $injector->callMethod($loudGreeter, 'greet', $arrayContext);

echo $res . PHP_EOL;
