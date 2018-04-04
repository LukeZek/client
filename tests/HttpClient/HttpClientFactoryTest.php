<?php

namespace LukeBozek\ApiClient\HttpClient;

use PHPUnit\Framework\TestCase;

class HttpClientFactoryTest extends TestCase
{
    public function testCanCreateHttpClient()
    {
        $httpClient = HttpClientFactory::getClient();

        $this->assertInstanceOf('LukeBozek\ApiClient\HttpClient\HttpClientInterface', $httpClient);
    }
}
