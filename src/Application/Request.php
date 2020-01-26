<?php

namespace Calculator\Application;

/**
 * Request class for encapsulate HTTP request's information
 *
 * @author sr_hosseini
 * 
 * @property string $documentRoot
 * @property string $remoteAddr
 * @property string $remotePort
 * @property string $serverSoftware
 * @property string $serverProtocol
 * @property string $serverName
 * @property string $serverPort
 * @property string $requestUri
 * @property string $scriptName
 * @property string $scriptFilename
 * @property string $phpSelf
 * @property string $httpHost
 * @property string $httpConnection
 * @property string $httpCacheControl
 * @property string $httpUpgradeInsecureRequests
 * @property string $httpUserAgent
 * @property string $httpAccept
 * @property string $httpAcceptEncoding
 * @property string $httpAcceptLanguage
 * @property string $httpCookie
 * @property string $requestTimeFloat
 * @property string $requestTime
 * @property string $requestMethod
 */
class Request implements RequestInterface
{
    /**
     *
     * @var string
     */
    protected $method;
    
    /**
     * @var string
     */
    protected $uriPath;
    
    /**
     * @var array
     */
    protected $queryParams;

    /**
     * @var array
     */
    protected $formData;

    function __construct()
    {
        $this->initialize();
    }

    /**
     * Assign values of SERVER to this class
     */
    protected function initialize()
    {
        foreach ($_SERVER as $key => $value) {
            $this->{self::snakeToCamelCase($key)} = $value;
        }
        
        $this->method = $this->requestMethod ? strtoupper($this->requestMethod) : 'GET';        
        $this->uriPath = rtrim(parse_url($this->requestUri, PHP_URL_PATH), '/') ?: '/';
        $this->queryParams = $_GET;
        $this->formData = $_POST;
    }

    /**
     * Convert a SNAKE_CASE string to camelCase
     * @param string $string
     * @return string
     */
    private static function snakeToCamelCase(string $string): string
    {
        /**
         * 1 - Make entire string lowercase
         * 2 - Capitalize first characters of all words delimited by underscore
         * 3 - Remove underscores
         * 4 - De-capitalizing first character of string
         */
        return lcfirst(str_replace('_', '', ucwords(strtolower($string), '_')));
    }

    /**
     * Returns entire form data in an array
     * @return array
     */
    public function getAllFormData(): array
    {
        return $this->formData;
    }

    /**
     * Returns all parameters in request query string
     * @return array
     */
    public function getAllQueryParam(): array
    {
        return $this->queryParams;
    }

    /**
     * Returns request's body
     * @return string
     */
    public function getBody(): string
    {
        
    }

    /**
     * Returns entire form data in an array
     * @param string $key
     * @return string
     */
    public function getFormdata(string $key): string
    {
        return $this->formData[$key] ?? '';
    }

    /**
     * Returns current request's method [GET, POST, ...]
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Returns the value associated to key in query string
     * @param string $key
     * @return string
     */
    public function getQueryParams(string $key): string
    {
        return $this->queryParams[$key] ?? '';
    }

    /**
     * Returns the path of requestUri
     * @return string
     */
    public function getUriPath(): string
    {
        return $this->uriPath;
    }
}
