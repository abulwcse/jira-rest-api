<?php
/**
 * Created by PhpStorm.
 * User: abulh
 * Date: 23/07/2017
 * Time: 12:56
 */

namespace Jira\Service;


use Jira\HttpClient;

class User
{
    /**
     * @var HttpClient
     */
    protected  $client;

    /**
     * Project constructor.
     * @param HttpClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Get the current user info
     *
     * @return object
     */
    public function me()
    {
        return $this->client->request('GET','/rest/api/2/myself');
    }

    /**
     * Get user info
     *
     * @param string $username
     *
     * @return object
     */
    public function getUserInfo($username)
    {
        return $this->client->request('GET','/rest/api/2/user?username=' . urlencode($username));
    }
}