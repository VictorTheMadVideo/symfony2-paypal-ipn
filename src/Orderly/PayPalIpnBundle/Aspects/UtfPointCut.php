<?php

namespace Orderly\PayPalIpnBundle\Aspects;


use JMS\AopBundle\Aop\PointcutInterface;

class UtfPointcut implements PointcutInterface
{
    public function matchesClass(\ReflectionClass $class)
    {
        return true;
    }

    public function matchesMethod(\ReflectionMethod $method)
    {
        return false !== strpos($method->name, 'setAddressStreet');
    }
}