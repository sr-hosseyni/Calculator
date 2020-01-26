<?php

namespace Calculator\Application;

/**
 *
 * @author sr_hosseini
 */
interface RequestInterface
{
    /**
     * Returns current request's method [GET, POST, ...]
     */
    public function getMethod(): string;
    
    /**
     * Returns the path of requestUri
     */
    public function getUriPath(): string;
    
    /**
     * Returns all parameters in request query string
     */
    public function getAllQueryParam(): array;
    
    /**
     * Returns the value associated to key in query string
     */
    public function getQueryParams(string $key): string;
    
    /**
     * Returns entire form data in an array
     */
    public function getAllFormData(): array;
    
    /**
     * Returns entire form data in array
     */
    public function getFormdata(string $key): string;
    
    /**
     * Returns request's body
     * @return string
     */
    public function getBody(): string;
}
