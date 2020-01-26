<?php

namespace Calculator\Tests\Mock\Application;

use Calculator\Application\ControllerInterface;
use Calculator\Application\DefaultControllerInterface;
use Calculator\Application\RequestInterface;

/**
 * Description of DefaultController
 *
 * @author sr_hosseini
 */
class DefaultController implements DefaultControllerInterface
{

    public function __construct()
    {
        
    }

    public function setConfig(array $config): ControllerInterface
    {
        return $this;
    }

    public function notFound(RequestInterface $request)
    {
        return DefaultControllerInterface::NotFound;
    }

    public function internalError(RequestInterface $request)
    {
        return DefaultControllerInterface::InternalError;
    }

}
