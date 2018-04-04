<?php

namespace LukeBozek\ApiClient;

use LukeBozek\ApiClient\Authentication\Authentication;
use LukeBozek\ApiClient\Exception\ApiException;
use LukeBozek\ApiClient\HttpClient\HttpClientFactory;
use LukeBozek\ApiClient\HttpClient\Request;
use LukeBozek\ApiClient\HttpClient\Response;

class Api
{
    private $apiClient;
    private $clientOptions;
    private $authenticator;

    public function __construct(array $options = [])
    {
        $this->clientOptions = array_merge([
            'login' => '',
            'password' => '',
            'auth_method' => ''
        ], $options);

        $this->authenticator = new Authentication($this->clientOptions);
        $this->apiClient = new ApiClient(HttpClientFactory::getClient());
    }

    /**
     * @throws ApiException
     */
    public function get(string $endpoint): Response
    {
        return $this->makeRequest($endpoint, 'GET', []);
    }

    /**
     * @throws ApiException
     */
    public function post(string $endpoint, array $data = []): Response
    {
        return $this->makeRequest($endpoint, 'POST', $data);
    }

    /**
     * @throws ApiException
     */
    private function makeRequest(string $endpoint, string $method, array $data): Response
    {
        $response = $this->apiClient->sendRequest(
            new Request(
                $endpoint,
                $method,
                $data,
                $this->authenticator
            )
        );

        return $response;
    }
}
