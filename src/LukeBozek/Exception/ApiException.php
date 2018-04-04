<?php

namespace LukeBozek\ApiClient\Exception;

use Exception;
use LukeBozek\ApiClient\HttpClient\Request;
use LukeBozek\ApiClient\HttpClient\Response;
use Throwable;

class ApiException extends Exception
{
    private $request;
    private $response;

    public function __construct(
        string $message = "",
        int $code = 0,
        Request $request = null,
        Response $response = null,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->response = $response;
        $this->request = $request;
    }

    public function getResponse(): ?Response
    {
        return $this->response;
    }

    public function getRequest(): ?Request
    {
        return $this->request;
    }
}
