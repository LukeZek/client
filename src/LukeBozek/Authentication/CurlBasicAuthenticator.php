<?php

namespace LukeBozek\ApiClient\Authentication;

use LukeBozek\ApiClient\HttpClient\Curl;

class CurlBasicAuthenticator implements AuthenticatorInterface
{
    private $client;
    private $options;

    public function __construct(Curl $client, $options)
    {
        $this->client = $client;
        $this->options = $options;
    }

    public function makeAuthentication()
    {
        $this->client->setopt(CURLOPT_USERPWD, $this->getAuthDataString());
    }

    private function getAuthDataString(): string
    {
        return  $this->options['login'] . ":" . $this->options['password'];
    }
}
