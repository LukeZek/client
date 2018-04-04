<?php

namespace LukeBozek\ApiClient;

use Exception;
use LukeBozek\ApiClient\Authentication\Authentication;
use LukeBozek\ApiClient\HttpClient\CurlHttpClient;
use LukeBozek\ApiClient\HttpClient\Request;
use LukeBozek\ApiClient\HttpClient\Response;
use LukeBozek\ApiClient\HttpClient\SimpleResponse;
use Mockery;
use PHPUnit\Framework\TestCase;

class ApiClientTest extends TestCase
{
    public function testThrowExceptionWhileSendRequestWithNotSupportedEndpoint()
    {
        $httpClientMock = Mockery::mock(CurlHttpClient::class);
        $auth = Mockery::mock(Authentication::class);

        $apiClient = new ApiClient($httpClientMock);

        $request = new Request('/testEndpoint', 'POST', [], $auth);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('This endpoint is not supported');

        $apiClient->sendRequest($request);
    }

    public function testCreatePostRequest()
    {
        $httpClientMock = Mockery::mock(CurlHttpClient::class);
        $auth = Mockery::mock(Authentication::class);

        $httpClientMock->shouldReceive('send')
            ->withArgs(['https://jsonplaceholder.typicode.com/posts', 'POST', [], $auth])
            ->once()
            ->andReturn(new SimpleResponse(200, [], ['success' => ['ok']]));

        $apiClient = new ApiClient($httpClientMock);

        $request = new Request('/posts', 'POST', [], $auth);

        $this->assertEquals(new Response([], ['success' => ['ok']], 200, $request), $apiClient->sendRequest($request));
    }

    public function testCreateGetRequest()
    {
        $httpCLientMock = Mockery::mock(CurlHttpClient::class);
        $auth = Mockery::mock(Authentication::class);

        $httpCLientMock->shouldReceive('send')
            ->withArgs(['https://jsonplaceholder.typicode.com/posts', 'GET', [], $auth])
            ->once()
            ->andReturn(new SimpleResponse(200, [], ['success' => ['ok']]));

        $apiClient = new ApiClient($httpCLientMock);

        $request = new Request('/posts', 'GET', [], $auth);

        $this->assertEquals(new Response([], ['success' => ['ok']], 200, $request), $apiClient->sendRequest($request));
    }

    public function testHandleBadRequest()
    {
        $httpCLientMock = Mockery::mock(CurlHttpClient::class);
        $auth = Mockery::mock(Authentication::class);

        $httpCLientMock->shouldReceive('send')
            ->withArgs(['https://jsonplaceholder.typicode.com/posts', 'GET', [], $auth])
            ->once()
            ->andReturn(new SimpleResponse(400, [], ['success' => false]));

        $apiClient = new ApiClient($httpCLientMock);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Request has failed');

        $request = new Request('/posts', 'GET', [], $auth);

        $apiClient->sendRequest($request);
    }

    public function testHandleUnexpectedRequestError()
    {
        $httpCLientMock = Mockery::mock(CurlHttpClient::class);
        $auth = Mockery::mock(Authentication::class);

        $httpCLientMock->shouldReceive('send')
            ->withArgs(['https://jsonplaceholder.typicode.com/posts', 'GET', [], $auth])
            ->once()
            ->andReturn(new SimpleResponse(500, [], []));

        $apiClient = new ApiClient($httpCLientMock);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Unexpected api error');

        $request = new Request('/posts', 'GET', [], $auth);

        $apiClient->sendRequest($request);
    }
}
