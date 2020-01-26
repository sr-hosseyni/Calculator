<?php

namespace Calculator\Application;

/**
 * Application's handler class
 *
 * @author sr_hosseini
 */
class Handler
{

    /**
     * Application configuration array, populated with default values
     * @var array
     */
    private $config = [
        /**
         * This controller will use for common actions with application
         */
        'default_controller' => DefaultController::class,
        
        /**
         * Default Request Class
         */
        'request_class' => Request::class
    ];

    /**
     *
     * @var array
     */
    private $routes;

    public function __construct(array $config, array &$routes)
    {
        $this->config = $config + $this->config;
        $this->routes = &$routes;
    }

    /**
     * Handle incoming request
     * @param array $config
     */
    public function handle(): string
    {
        /* @var $request Request */
        $request = new $this->config['request_class']();
        $path = $this->resolve($request);
        return $this->dispatch($path, $request);
    }

    /**
     * Resolving requested path
     *
     * @param \Calculator\Application\Request $request
     * @param array $routes
     * @return string returns matchedRoute
     */
    private function resolve(RequestInterface $request): string
    {
        return sprintf('%s %s', $request->getMethod(), $request->getUriPath());
    }

    /**
     * 
     * @param string $matchedRoute
     * @return void
     */
    public function dispatch(string $path, RequestInterface $request): string
    {
        /**
         * trying to find matched route
         */
        $action = $this->routes[$path] ?? [
            $this->config['default_controller'],
            DefaultControllerInterface::NotFound
        ];
        
        /**
         * Handling with controllers
         * zero index is name of controller and it must become an object
         */
        if (is_array($action) && isset($action[0]) && class_exists($action[0])) {
            /**
             * get an instance of the class
             */
            $instance = new $action[0]();

            /**
             * If instance is a Controller, It must implement ControllerInterface
             */
            if ($instance instanceof ControllerInterface) {

                /**
                 * set config array in controller and put it in action again
                 */
                $action[0] = $instance->setConfig($this->config);
            }
        }

        /**
         * if action is not callable, there is an error in route table
         * e.g. when providec class name is not actual controller name
         */
        if (!is_callable($action)) {
            return $this->HandleInternalError($request);
        }

        /**
         * delete route table to de-allocating the used memory
         */
        $this->routes = [];

        /**
         * dispatching with detected action (Closure, function or action in a controller)
         */
        try {
            return $this->run($action, $request);
        } catch (\Exception $exc) {
            return $this->HandleInternalError($request);
        }

    }
    
    /**
     * Internal error handling
     * @param \Calculator\Application\RequestInterface $request
     */
    private function HandleInternalError(RequestInterface $request)
    {
        $action = [
            new $this->config['default_controller'](),
            DefaultControllerInterface::InternalError
        ];

        return $this->run($action, $request);
    }

    /**
     * call callable action
     * @param callable $action
     * @param \Calculator\Application\RequestInterface $request
     * @return string
     */
    private function run(callable $action, RequestInterface $request): string
    {
        return call_user_func_array($action, array($request));
    }
}
