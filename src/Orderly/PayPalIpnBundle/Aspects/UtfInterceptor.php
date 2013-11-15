<?php

namespace Orderly\PayPalIpnBundle\Aspects;

use CG\Proxy\MethodInterceptorInterface;
use CG\Proxy\MethodInvocation;

class UtfInterceptor implements MethodInterceptorInterface
{

    public function __construct()
    {

    }

    public function intercept(MethodInvocation $invocation)
    {
        list($arg0) = $invocation->arguments;
                
        if(gettype($arg0) == "string"){
            if(!$this->isUtf8($arg0)){
                $stringUtf = $this->setToUtf8($arg0);
                $invocation->arguments[0] = $stringUtf;
            }
           
        }
        
        // make sure to proceed with the invocation otherwise the original
        // method will never be called
        return $invocation->proceed();
    }
    
    private function isUtf8($string)
    {
        // From http://w3.org/International/questions/qa-forms-utf-8.html 
        if(mb_detect_encoding($string, "UTF-8, ISO-8859-1, GBK") != "UTF-8")
        {
            return false;
        }
        return true;
    }
    
    private function setToUtf8($string)
    {
        return iconv(mb_detect_encoding($string, mb_detect_order(), true), "UTF-8", $string);
    }
}