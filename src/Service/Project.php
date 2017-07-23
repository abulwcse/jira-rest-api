<?php

namespace Jira\Service;

use Jira\HttpClient;

class Project
{
    /**
     * @var HttpClient
     */
    protected  $client;

    /**
     * Project constructor.
     *
     * @param HttpClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Get All project list
     *
     * @return object[]
     */
    public function getAllProject()
    {
        return $this->client->request('GET','/rest/api/2/project');
    }

    /**
     * Get a project info
     *
     * @param string $projectKey
     *
     * @return object
     */
    public function getInfo($projectKey)
    {
        return $this->client->request('GET','/rest/api/2/project/' . urlencode($projectKey));
    }

    /**
     * A all version related to project
     *
     * @param string $projectKey
     *
     * @return object[]
     */
    public function getAllVersionList($projectKey)
    {
        return $this->client->request('GET','/rest/api/2/project/' . urlencode($projectKey) .'/versions');
    }

    /**
     * List of Released version of a project
     *
     * @param string $projectKey
     *
     * @return object[]
     */
    public function getReleaseVersionList($projectKey)
    {
        $response = $this->client->request('GET','/rest/api/2/project/' . urlencode($projectKey) .'/versions');
        $versions = json_decode($response->getBody());
        $list = [];
        foreach ($versions as $version) {
            if ($version->released) {
                $list[] = $version;
            }
        }
        return $list;
    }

    /**
     * List of unreleased version of a project
     *
     * @param string $projectKey
     *
     * @return object[]
     */
    public function getUnreleaseVersionList($projectKey)
    {
        $response = $this->client->request('GET','/rest/api/2/project/' . urlencode($projectKey) .'/versions');
        $versions = json_decode($response->getBody());
        $list = [];
        foreach ($versions as $version) {
            if (!$version->released) {
                $list[] = $version;
            }
        }
        return $list;
    }
}