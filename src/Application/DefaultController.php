<?php

namespace Calculator\Application;

use Calculator\Application\ControllerInterface;
use Calculator\Application\DefaultControllerInterface;
use Calculator\Application\Request;

/**
 * Description of DefaultController
 *
 * @author sr_hosseini
 */
class DefaultController implements DefaultControllerInterface
{
    public function setConfig(array $config): ControllerInterface
    {
        $this->config = $config;
        
        return $this;
    }

    public function notFound(RequestInterface $request)
    {
        return '404, Not Found!';
    }

    public function internalError(RequestInterface $request)
    {
        return '503, Internal Error!';
    }

    public function __construct()
    {
        
    }

}
