<?php

namespace LukeBozek\ApiClient;

use LukeBozek\ApiClient\Exception\ApiException;
use LukeBozek\ApiClient\HttpClient\HttpClientInterface;
use LukeBozek\ApiClient\HttpClient\Request;
use LukeBozek\ApiClient\HttpClient\Response;

class ApiClient
{
    private $apiBaseUrl = 'https://jsonplaceholder.typicode.com';
    private $apiVersion = 'v1';
    private $avaiableEndpoint = [
        '/posts',
    ];
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @throws ApiException
     */
    public function sendRequest(Request $request): Response
    {
        if ($this->isEndpointSupported($request->getEndpoint())) {
            throw new ApiException('This endpoint is not supported', 0);
        }

        $rawResponse = $this->httpClient->send(
            $this->apiBaseUrl . $request->getEndpoint(),
            $request->getMethod(),
            $request->getOptions(),
            $request->getAuth()
        );

        if (empty($rawResponse->getBody()) && empty($rawResponse->getHeader())) {
            throw new ApiException(
                'Unexpected api error',
                500,
                $request,
                new Response([], ['error' => ['unexpected api error']], 500, $request)
            );
        }

        $body = $rawResponse->getBody();
        if (isset($body['success']) && !$body['success']) {
            throw new ApiException(
                'Request has failed',
                $rawResponse->getHttpStatus(),
                $request,
                new Response($rawResponse->getHeader(), $rawResponse->getBody(), $rawResponse->getHttpStatus(), $request)
            );
        }

        return new Response(
            $rawResponse->getHeader(),
            $rawResponse->getBody(),
            $rawResponse->getHttpStatus(),
            $request
        );
    }

    public function isEndpointSupported(string $endpoint)
    {
        return !in_array($endpoint, $this->avaiableEndpoint) ? true : false;
    }
}
