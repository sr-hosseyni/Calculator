<?php

namespace Calculator\Tests\Mock\Controllers;

use Calculator\Application\ControllerInterface;
use Calculator\Application\Request;

/**
 * Description of FooController
 *
 * @author sr_hosseini
 */
class FooController implements ControllerInterface
{

    const RETURN_VALUE = 'FooController::someAction';

    //put your code here
    public function __construct()
    {
        
    }

    public function setConfig(array $config): ControllerInterface
    {
        return $this;
    }

    public function someAction(Request $request): string
    {
        return self::RETURN_VALUE;
    }
}
