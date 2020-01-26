<?php

namespace Calculator\Tests\Mock\Application;

use Calculator\Application\RequestInterface;

/**
 * Description of Request
 *
 * @author sr_hosseini
 */
class DummyRequest implements RequestInterface
{
    
    public function getAllFormData(): array
    {
        
    }

    public function getAllQueryParam(): array
    {
        
    }

    public function getBody(): string
    {
        
    }

    public function getFormdata(string $key): string
    {
        
    }

    public function getMethod(): string
    {
        
    }

    public function getQueryParams(string $key): string
    {
        
    }

    public function getUriPath(): string
    {
        
    }
}
