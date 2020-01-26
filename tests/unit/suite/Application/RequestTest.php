<?php
namespace Calculator\Tests\Application;

use Calculator\Application\Request;
use Calculator\Application\RequestInterface;
use Calculator\Tests\UnitTestCase;

/**
 * @author sr_hosseini
 */
final class RequestTest extends UnitTestCase
{
    public function testImplementInterface()
    {
        $this->assertInstanceOf(RequestInterface::class, new Request());
    }
    
    /**
     * @dataProvider serverArrayDictionary
     */
    public function testCamelize(string $snakeCaseString, string $expected): void
    {
        $requst = new Request();
        $result  = $this->invokeMethod($requst, 'snakeToCamelCase', [$snakeCaseString]);
        $this->assertEquals($expected, $result);
    }
    
    public function serverArrayDictionary(): array
    {
        return [
            ['THIS_IS_SNAKE_CASE', 'thisIsSnakeCase'],
            ['HTTP_UPGRADE_INSECURE_REQUESTS', 'httpUpgradeInsecureRequests'],
            ['REQUEST_URI', 'requestUri'],
            ['REQUEST', 'request'],
            ['_REQUEST', 'request'],
            ['REQUEST_', 'request'],
            ['_REQUEST_', 'request'],
            ['_REQUEST_URI', 'requestUri'],
            ['REQUEST_URI_', 'requestUri'],
            ['_REQUEST_URI_', 'requestUri']
        ];
    }
    
    public function requestUriProvider(): array
    {
        return [
            ['/', '/'],
            ['//', '/'],
            ['', '/'],
            ['?', '/'],
            ['/?', '/'],
            ['/path?x=y&y=z', '/path'],
            ['/path/?x=y&y=z', '/path'],
            ['/path/foo/bar', '/path/foo/bar'],
            ['/path/foo/bar/', '/path/foo/bar'],
            ['/path/foo/bar//', '/path/foo/bar'],
            ['/path/foo/bar//?', '/path/foo/bar'],
            ['/path/foo/bar?', '/path/foo/bar'],
            ['/path/foo/bar?x=y&y=z', '/path/foo/bar'],
            ['/path/foo/bar/?x=y&y=z', '/path/foo/bar'],
            ['/pa-th/fo-o/b-ar?x=y&y=z', '/pa-th/fo-o/b-ar'],
        ];
    }

    /**
     * @dataProvider requestUriProvider
     */
    public function testRequestUri($uri, $expected)
    {
        $_SERVER['REQUEST_URI'] = $uri;
        $requst = new Request();
        $this->assertEquals($expected, $requst->getUriPath());
        unset($_SERVER['REQUEST_URI']);
    }
}
