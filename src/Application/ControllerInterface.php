<?php

namespace Calculator\Application;

/**
 * Description of ControllerInterface
 *
 * @author sr_hosseini
 */
interface ControllerInterface
{
    /**
     * constructor should not has any arguments
     */
    public function __construct();
    
    /**
     * 
     * @param array $config
     */
    public function setConfig(array $config): ControllerInterface;
}
