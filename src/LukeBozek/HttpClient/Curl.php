<?php

namespace LukeBozek\ApiClient\HttpClient;

class Curl
{
    private $curl;

    public function init($url)
    {
        $this->curl = curl_init($url);
    }

    public function setopt(string $key, $value)
    {
        curl_setopt($this->curl, $key, $value);
    }

    public function setoptFromArray(array $options)
    {
        curl_setopt_array($this->curl, $options);
    }

    public function exec()
    {
        return curl_exec($this->curl);
    }

    public function getHttpStatusCode()
    {
        return curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
    }

    public function close()
    {
        curl_close($this->curl);
    }

    public function error()
    {
        return curl_errno($this->curl);
    }
}
