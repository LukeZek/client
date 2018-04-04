<?php

namespace LukeBozek\ApiClient\HttpClient;

use LukeBozek\ApiClient\Util\ArrayNodeExtractor;

class Response
{
    protected $body;
    protected $header;
    protected $code;
    protected $request;

    public function __construct(array $header, array $body, string $code, Request $request)
    {
        $this->body = $body;
        $this->header = $header;
        $this->code = $code;
        $this->request = $request;
    }

    public function getHeader(): array
    {
        return $this->header;
    }

    public function getStatus(): string
    {
        return $this->code;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getEndpoint(): string
    {
        return $this->request->getEndpoint();
    }

    public function getRequestData(): array
    {
        return $this->request->getOptions();
    }

    /**
     * @return array | string
     */
    public function getDataByQuery(string $query)
    {
        $query = explode("=>", $query);
        $data = $this->body;

        return $this->resolveArrayNode($data, $query);
    }

    public function getData(): array
    {
        return $this->body['data']?? [];
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function hasErrors(): bool
    {
        return !empty($this->body['error']);
    }

    public function getError(): array
    {
        return $this->body['error']?? [];
    }

    public function getErrorsMessages(): array
    {
        return $this->body['error']['messages'] ?? [];
    }

    /**
     * @return array | string
     */
    private function resolveArrayNode(array $array, array $node)
    {
        return ArrayNodeExtractor::extractArrayNode($array, $node);
    }
}
