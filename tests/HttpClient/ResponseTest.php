<?php

namespace LukeBozek\ApiClient\HttpClient;

use LukeBozek\ApiClient\Authentication\Authentication;
use LukeBozek\ApiClient\Collection;
use Mockery;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testReturnBody()
    {
        $auth = Mockery::mock(Authentication::class);

        $response = new Response(
            [],
            ['testKey1' => 'testValue1', 'testKey2' => 'testValue2'],
            '',
            new Request('testEndpoint', 'POST', [], $auth)
        );

        $this->assertEquals(['testKey1' => 'testValue1', 'testKey2' => 'testValue2'], $response->getBody());
    }
}
