<?php

namespace Jira;


use Jira\Authentication\AuthenticationServiceInterface;

class HttpClient extends \GuzzleHttp\Client
{
    /**
     * @var AuthenticationServiceInterface
     */
    private $authConfiguration;

    /**
     * @return AuthenticationServiceInterface
     */
    public function getAuthConfiguration()
    {
        return $this->authConfiguration;
    }

    /**
     * @param AuthenticationServiceInterface $authConfiguration
     */
    public function setAuthConfiguration(AuthenticationServiceInterface $authConfiguration)
    {
        $this->authConfiguration = $authConfiguration;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return mixed
     * @throws \Exception
     */
    public function request($method, $uri = '', array $options = [])
    {
        try {
            $response =  parent::request($method, $uri, array_merge($options, $this->getAuthConfiguration()->getAuthOption()))->getBody();
        } catch (\Exception $exception) {
            $response = json_encode(['code' => $exception->getCode(), 'error_message' => $exception->getMessage()]);
        }
        return json_decode($response);

    }
}