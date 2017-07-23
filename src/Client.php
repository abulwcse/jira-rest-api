<?php

namespace Jira;


use Jira\Authentication\AuthenticationServiceInterface;
use Jira\Authentication\BasicAuthenticationService;
use Jira\Service\Issue;
use Jira\Service\Project;
use Jira\Service\User;
use Jira\Service\Version;

class Client
{
    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * Client constructor.
     *
     * @param $baseURL
     * @param AuthenticationServiceInterface $authenticationConfig
     */
    public function __construct($baseURL, AuthenticationServiceInterface $authenticationConfig)
    {
        $this->client = new HttpClient(['base_uri' => $baseURL]);
        $this->client->setAuthConfiguration($authenticationConfig);
    }

    public function get($resourceType)
    {
        switch ($resourceType) {
            case 'project':
                return new Project($this->client);
                break;
            case 'user':
                return new User($this->client);
                break;
            case 'issue':
                return new Issue($this->client);
                break;
            case 'version':
                return new Version($this->client);
                break;
            default:
                throw new \Exception("Unable to find service");
                break;
        }
    }
}