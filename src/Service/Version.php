<?php

namespace Jira\Service;


use Jira\HttpClient;

class Version
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
     * @param string $versionId
     * @return object
     */
    public function getVersion($versionId)
    {
        return $this->client->request('GET','/rest/api/2/version/'. urlencode($versionId));
    }

    /**
     * Update the version
     *
     * @param object $version
     */
    public function updateVersion($version)
    {
        $this->client->request('PUT','/rest/api/2/version/'. $version->id);
    }
}