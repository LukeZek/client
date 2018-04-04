<?php

namespace LukeBozek\ApiClient\HttpClient;

class HttpClientFactory
{
    public static function getClient(): HttpClientInterface
    {
        return new CurlHttpClient(new Curl());
    }
}
