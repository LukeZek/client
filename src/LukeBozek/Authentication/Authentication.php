<?php

namespace LukeBozek\ApiClient\Authentication;

class Authentication
{
    private $authData;
    private $client;
    private $authMethod;

    const BASIC_AUTHENTICATION = 'basic';

    public function __construct(array $options)
    {
        $this->authData = $options;
        $this->authMethod = $options['auth_method'];
    }

    public function authenticate()
    {
        switch (strtolower($this->authMethod)) {
            case static::BASIC_AUTHENTICATION:  
                (new BasicAuthentication($this->client, $this->authData))->authenticate();
				break;
        }
		
		return true;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client)
    {
        $this->client = $client;
    }
}
