<?php

namespace Orderly\PayPalIpnBundle\Aspects;

use CG\Proxy\MethodInterceptorInterface;
use CG\Proxy\MethodInvocation;
use Symfony\Component\Console\Output\ConsoleOutput;

class UtfInterceptor implements MethodInterceptorInterface
{

    private $output;
    
    public function __construct() {
        $this->output = new ConsoleOutput;
    }
    public function intercept(MethodInvocation $invocation)
    {
        list($arg0) = $invocation->arguments;
                
        $this->output->writeln("Interceptado Set ".$arg0);
        //if(gettype($arg0) == "string"){
            if(!$this->isUtf8($arg0)){
                $stringUtf = $this->setToUtf8($arg0);
                $invocation->arguments[0] = $stringUtf;
            }       
        //}
        
        // make sure to proceed with the invocation otherwise the original
        // method will never be called
        return $invocation->proceed();
    }
    
    private function isUtf8($string) {
        // From http://w3.org/International/questions/qa-forms-utf-8.html
        return preg_match('%^(?:
              [\x09\x0A\x0D\x20-\x7E]            # ASCII
            | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
            |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
            | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
            |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
            |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
            | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
            |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
        )*$%xs', $string);
    }   

    private function setToUtf8($string) { 
        return iconv(mb_detect_encoding($string, mb_detect_order(), true), "UTF-8", $string);
    }
}