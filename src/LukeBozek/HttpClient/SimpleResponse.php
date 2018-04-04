<?php

namespace LukeBozek\ApiClient\HttpClient;

class SimpleResponse
{
    private $header;
    private $body;
    private $httpStatus;

    public function __construct(int $httpStatus, array $header = [], array $body = [])
    {
        $this->header = $header;
        $this->body = $body;
        $this->httpStatus = $httpStatus;
    }

    public function getHeader(): array
    {
        return $this->header;
    }

    public function setHeader($header)
    {
        $this->header = $header;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }

    public function setHttpStatus(int $httpStatus)
    {
        $this->httpStatus = $httpStatus;
    }
}
