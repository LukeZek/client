<?php

namespace LukeBozek\ApiClient\HttpClient;

use LukeBozek\ApiClient\Authentication\Authentication;

class CurlHttpClient implements HttpClientInterface
{
    private $curl;

    const GET_METHOD = 'GET';
    const POST_METHOD = 'POST';

    public function __construct(Curl $curl)
    {
        $this->curl = $curl;
    }

    public function send(string $url, string $method, array $data, Authentication $auth): SimpleResponse
    {
        $this->curlInit($url);

        $auth->setClient($this->curl);
        $auth->authenticate();

        if (strtoupper($method) !== self::GET_METHOD) {
            $this->curl->setopt(CURLOPT_POSTFIELDS, json_encode($data, true));
        }

        $this->curl->setoptFromArray([
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => $method === self::GET_METHOD ? 0 : 1
        ]);

        $result = $this->curl->exec();
        $httpStatus = $this->curl->getHttpStatusCode();

        $this->curlClose();

        //TODO Add header extracting
        return new SimpleResponse($httpStatus, [], json_decode($result, true)?? []);
    }

    private function curlInit($url)
    {
        $this->curl->init($url);
    }

    private function curlClose()
    {
        $this->curl->close();
    }
}
