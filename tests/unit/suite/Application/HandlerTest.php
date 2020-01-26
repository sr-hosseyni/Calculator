<?php

namespace Calculator\Tests\Application;

use Calculator\Application\DefaultControllerInterface;
use Calculator\Application\Handler;
use Calculator\Tests\Mock\Controllers\BarController;
use Calculator\Tests\Mock\Application\DefaultController;
use Calculator\Tests\Mock\Controllers\FooController;
use Calculator\Tests\Mock\Application\Request;
use Calculator\Tests\UnitTestCase;

/**
 * Description of HandlerTest
 *
 * @author sr_hosseini
 */
final class HandlerTest extends UnitTestCase
{

    const VALUE_FOR_GET_ROOT = 'THIS IS GET ROOT';
    const VALUE_FOR_POST_ROOT = 'THIS IS POST TO ROOT';

    public function routeTableConfigAndRequestsProvider(): array
    {
        $routes = [
            'GET /' => function() {
                return self::VALUE_FOR_GET_ROOT;
            },
            'POST /' => function() {
                return self::VALUE_FOR_POST_ROOT;
            },
            'GET /something' => [FooController::class, 'someAction'],
            'POST /something' => [FooController::class, 'someAction'],
            'GET /alias-for-something' => [FooController::class, 'someAction'],
            'GET /bar/some' => [BarController::class, 'firstAction'],
            'GET /bar/second' => [BarController::class, 'secondAction'],
            'POST /bar/some' => [BarController::class, 'secondAction']
        ];

        $config = [
            'default_controller' => DefaultController::class,
            'request_class' => Request::class,
        ];

        return [
            [$config, $routes, '/', 'GET', self::VALUE_FOR_GET_ROOT],
            [$config, $routes, '/', 'POST', self::VALUE_FOR_POST_ROOT],
            [$config, $routes, '/something', 'GET', FooController::RETURN_VALUE],
            [$config, $routes, '/something/', 'GET', FooController::RETURN_VALUE],
            [$config, $routes, '/something/', 'POST', FooController::RETURN_VALUE],
            [$config, $routes, '/alias-for-something', 'GET', FooController::RETURN_VALUE],
            [$config, $routes, '/alias-for-something', 'POST', DefaultControllerInterface::NotFound],
            [$config, $routes, '/bar/some', 'GET', BarController::FIRST_ACTION_RETURN_VALUE],
            [$config, $routes, '/bar/second', 'GET', BarController::SECOND_ACTION_RETURN_VALUE],
            [$config, $routes, '/bar/some', 'POST', BarController::SECOND_ACTION_RETURN_VALUE]
        ];
    }

    /**
     * 
     * @dataProvider routeTableConfigAndRequestsProvider
     */
    public function testDispatcher(array $config, array $routes, string $uri, string $method, string $expected): void
    {
        Request::setUriPath($uri);
        Request::setRequestMethod($method);

        $app = new Handler($config, $routes);
        $output = $app->handle();

        $this->assertEquals($expected, $output);
    }

    public function testRouteTableShouldUnsetBeforeDispatch()
    {
        $routes = [
            'GET /' => function() {
                return 'THIS IS A';
            },
            'POST /' => function() {
                return 'THIS IS A';
            }
        ];

        $app = new Handler($config = [], $routes);
        $app->handle();

        $this->assertArrayNotHasKey('GET /', $routes);
        $this->assertArrayNotHasKey('POST /', $routes);
    }

    public function defaultControllersTestProvider(): array
    {
        $routes = [
            'GET /' => function() {
                return 'THIS IS A';
            },
            // for generating internal error
            'GET /path' => []
        ];

        return [
            // using custom default controller
            [
                $routes,
                [
                    'default_controller' => DefaultController::class,
                    'request_class' => Request::class
                ],
                '/path-which-is-not-exists',
                DefaultController::NotFound
            ],
            // Using default controller of application itself
            [
                $routes,
                ['request_class' => Request::class],
                '/path-which-is-not-exists',
                '404, Not Found!'
            ],
            // using custom default controller
            [
                $routes,
                [
                    'default_controller' => DefaultController::class,
                    'request_class' => Request::class
                ],
                '/path',
                DefaultController::InternalError
            ],
            // Using default controller of application itself
            [
                $routes,
                ['request_class' => Request::class],
                '/path',
                '503, Internal Error!'
            ]
        ];
    }

    /**
     * @dataProvider defaultControllersTestProvider
     */
    public function testDefaultController(array $routes, array $config, string $requestUrl, string $expected): void
    {
        Request::setUriPath($requestUrl);
        Request::setRequestMethod('GET');

        $app = new Handler($config, $routes);
        $actual = $app->handle();

        $this->assertEquals($expected, $actual);
    }

}
