<?php

// Require the Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

use Acclimate\Container\ArrayContainer;

$data = [
    'greeting' => 'Hello world'
];

// A simple in-memory container, implementing the standard ContainerInterface
$container = new ArrayContainer($data);

echo $container->get('greeting') . PHP_EOL;
