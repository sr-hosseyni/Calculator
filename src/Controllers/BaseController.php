<?php

namespace Calculator\Controllers;

use Calculator\Application\ControllerInterface;

/**
 * Description of BaseController
 *
 * @author sr_hosseini
 */
abstract class BaseController implements ControllerInterface
{
    /**
     * @var array
     */
    public $config;
    
    /**
     * Variables for rendering in view
     * @var array
     */
    protected $view = [];

    public function __construct()
    {
        
    }

    /**
     * 
     * @param array $config
     * @return \self
     */
    public function setConfig(array $config): ControllerInterface
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Render view template
     * @param type $name
     */
    protected function render($name)
    {
        extract($this->view, EXTR_SKIP);
        ob_start();
        include sprintf('%s/%s.php', $this->config['views_templates_path'], $name);
        return ob_get_clean();
    }
}
