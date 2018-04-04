<?php

namespace LukeBozek\ApiClient\HttpClient;

use LukeBozek\ApiClient\Authentication\Authentication;

class Request
{
    private $endpoint;
    private $method;
    private $options;
    private $auth;

    public function __construct(string $endpoint, string $method, array $options, Authentication $auth)
    {
        $this->endpoint = $endpoint;
        $this->method = $method;
        $this->options = $options;
        $this->auth = $auth;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function setEndpoint(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method)
    {
        $this->method = $method;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    public function getAuth(): Authentication
    {
        return $this->auth;
    }

    public function setAuth(Authentication $auth)
    {
        $this->auth = $auth;
    }
}
