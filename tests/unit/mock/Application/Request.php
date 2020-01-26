<?php

namespace Calculator\Tests\Mock\Application;

use Calculator\Application\Request as AppRequest;

/**
 * Description of Request
 *
 * @author sr_hosseini
 */
class Request extends AppRequest
{
    protected static $rMethod = 'GET';
    protected static $path = '/';
    
    public function getMethod(): string
    {
        return self::$rMethod ? strtoupper(self::$rMethod) : 'GET';
    }

    public function getUriPath(): string
    {
        return rtrim(parse_url(self::$path, PHP_URL_PATH), '/') ?: '/';
    }

    public static function setRequestMethod(string $method): void
    {
        self::$rMethod = $method;
    }
    
    public static function setUriPath(string $uri): void
    {
        self::$path = $uri;
    }
}
