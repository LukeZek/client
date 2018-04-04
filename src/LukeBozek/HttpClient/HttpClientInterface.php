<?php

namespace LukeBozek\ApiClient\HttpClient;

use LukeBozek\ApiClient\Authentication\Authentication;

interface HttpClientInterface
{
    public function send(string $url, string $method, array $data, Authentication $auth): SimpleResponse;
}
