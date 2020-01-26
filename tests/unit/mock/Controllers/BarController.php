<?php

namespace Calculator\Tests\Mock\Controllers;

use Calculator\Application\ControllerInterface;
use Calculator\Application\Request;

/**
 * Dummy Controller, FooController
 *
 * @author sr_hosseini
 */
class BarController implements ControllerInterface
{
    const FIRST_ACTION_RETURN_VALUE = 'BarController::firstAction';
    const SECOND_ACTION_RETURN_VALUE = 'Second Action\'s Response';


    //put your code here
    public function __construct()
    {
        
    }

    public function setConfig(array $config): ControllerInterface
    {
        return $this;
    }
    
    public function firstAction(Request $request): string
    {
        return self::FIRST_ACTION_RETURN_VALUE;
    }

    public function secondAction(Request $request): string
    {
        return self::SECOND_ACTION_RETURN_VALUE;
    }
    
}
