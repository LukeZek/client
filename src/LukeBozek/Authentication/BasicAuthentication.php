<?php

namespace LukeBozek\ApiClient\Authentication;

class BasicAuthentication
{
    private $authData;
    private $authenticator;
    private $client;

    public function __construct($client, array $options)
    {
        $this->client = $client;
        $this->authData = $options;

        $this->authenticator = $this->createAuthenticator();
    }

    private function createAuthenticator()
    {
        return new CurlBasicAuthenticator($this->client, $this->authData);
    }

    public function authenticate()
    {
        $this->authenticator->makeAuthentication();
    }
}
