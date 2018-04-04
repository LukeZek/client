<?php

namespace LukeBozek\ApiClient\HttpClient;

use LukeBozek\ApiClient\Authentication\Authentication;
use LukeBozek\ApiClient\Authentication\CurlBasicAuthenticator;
use Mockery;
use PHPUnit\Framework\TestCase;

class CurlHttpClientTest extends TestCase
{
    protected $curlMock;
    protected $auth;

    /**
     * @var CurlHttpClient
     */
    protected $curlHttpClientClient;

    protected function setUp()
    {
        $this->curlMock = Mockery::mock(Curl::class);
        $this->curlHttpClientClient = new CurlHttpClient($this->curlMock);
        $this->auth = Mockery::mock(Authentication::class);

        $this->curlMock->shouldReceive('setopt');
        $this->auth->shouldReceive('setClient')->with($this->curlMock);
        $this->auth->shouldReceive('authenticate')->andReturn(true);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testCanSendRequest()
    {
        $this->curlMock
            ->shouldReceive('init')->with('testUrl')
            ->once()
            ->andReturn(null);
        $this->curlMock
            ->shouldReceive('setoptFromArray')
            ->once()->with([
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POST => 0
            ])
            ->andReturn(null);
        $this->curlMock
            ->shouldReceive('getHttpStatusCode')
            ->once()
            ->andReturn(200);
        $this->curlMock
            ->shouldReceive('exec')
            ->once()
            ->andReturn('{}');

        $this->curlMock
            ->shouldReceive('close')
            ->once()
            ->andReturn(null);

        $this->assertEquals(
            new SimpleResponse(200, [], []),
            $this->curlHttpClientClient->send(
                'testUrl',
                'GET',
                [],
                $this->auth
            )
        );
    }

    public function testCanSendRequestWithAuth()
    {
        $this->curlMock
            ->shouldReceive('init')->with('testUrl')
            ->once()
            ->andReturn(null);
        $this->curlMock
            ->shouldReceive('setoptFromArray')
            ->once()->with([
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_POST => 0
            ])
            ->andReturn(null);
        $this->curlMock
            ->shouldReceive('getHttpStatusCode')
            ->once()
            ->andReturn(200);
        $this->curlMock
            ->shouldReceive('exec')
            ->once()
            ->andReturn('{}');
        $this->curlMock
            ->shouldReceive('close')
            ->once()
            ->andReturn(null);

        $this->assertEquals(
            new SimpleResponse(200, [], []),
            $this->curlHttpClientClient->send(
                'testUrl',
                'GET',
                [],
                $this->auth
            )
        );
    }
}
