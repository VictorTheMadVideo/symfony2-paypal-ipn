<?php

namespace Orderly\PayPalIpnBundle\Aspects;


use JMS\AopBundle\Aop\PointcutInterface;

class UtfPointcut implements PointcutInterface
{
    public function matchesClass(\ReflectionClass $class)
    {
        if($class->getName() == 'Orderly\PayPalIpnBundle\Document\IpnLog' || 
                $class->getName() == 'Orderly\PayPalIpnBundle\Document\IpnOrders'){
            return true;
        }
        return false;
    }

    public function matchesMethod(\ReflectionMethod $method)
    {
        return false !== \strpos($method->name, 'set');
    }
}