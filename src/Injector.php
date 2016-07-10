<?php

namespace InteroPhp\Injector;

use Interop\Container\ContainerInterface;
use InteroPhp\Injector\Context;
use ReflectionClass;
use Iterator;
use InteroPhp\Injector\Exception\InjectionException;
use InteroPhp\Injector\Context\ContextInterface;

class Injector
{
    public function instantiate($className, ContextInterface $context)
    {
        $reflectionClass = new ReflectionClass($className);
        $constructor = $reflectionClass->getConstructor();
        $arguments = $this->resolveParameters($constructor->getParameters(), $context);
        $object = $reflectionClass->newInstanceArgs($arguments);
        return $object;
    }
    
    public function callMethod($obj, $methodName, ContextInterface $context)
    {
        $reflectionClass = new ReflectionClass(get_class($obj));
        if (!$reflectionClass->hasMethod($methodName)) {
            throw new InjectionException(
                "Method `" . $methodName . "` does not exist on class `" . $reflectionClass->getName() . "`"
            );
        }
        $reflectionMethod = $reflectionClass->getMethod($methodName);
        $arguments = $this->resolveParameters($reflectionMethod->getParameters(), $context);
        $result = $reflectionMethod->invokeArgs($obj, $arguments);
        return $result;
    }
    
    public function resolveParameters(array $parameters, ContextInterface $context)
    {
        $arguments = [];
        foreach ($parameters as $parameter) {
            $value = $this->resolveParameter($parameter, $context);
            $arguments[$parameter->getName()] = $value;
        }
        return $arguments;
    }
    
    public function resolveParameter($parameter, ContextInterface $context)
    {
        // Normalize the parameter name
        $name = $parameter->getName();
        $name = str_replace('__', '.', $name);
        
        if ($context->has($name)) {
            return $context->get($name);
        }
        
        // Try to resolve the parameter by class/interface
        $reflectionClass = $parameter->getClass();
        if (!$reflectionClass) {
            // Can't find it anywhere, throw exception
            throw new InjectionException(
                "Can't resolve parameter `" . $name . "` by name (and it doesn't have a class or interface)"
            );
        }
        
        $fullClassName = $reflectionClass->getName();
        // Check if the parameter class/interface name is defined in the container
        if ($context->has($fullClassName)) {
            return $context->get($fullClassName);
        }

        // Finally loop over all the keys in the container, and check if their type matches the requested object
        /*
        if ($context instanceof Iterator) {
            foreach ($context as $key => $value) {
                if ($value instanceof $fullClassName) {
                    return $value;
                }
            }
        }
        */
        
        // Can't find it anywhere, throw exception
        throw new InjectionException(
            "Can't resolve parameter `" . $name . "` by name or className `". $fullClassName . "`"
        );
    }
}
