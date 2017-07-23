<?php

namespace Jira\Service;


use Jira\HttpClient;

class Issue
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
     * Search for issues based on JQL
     *
     * @param $jql
     *
     * @return object
     */
    public function search($jql)
    {
        return $this->client->request('GET','/rest/api/2/search?jql='.urlencode($jql));
    }

    /**
     * Get Details about a issue
     *
     * @param $issueKey
     *
     * @return object
     */
    public function getIssue($issueKey)
    {
        return $this->client->request('GET','/rest/api/2/issue/'. urlencode($issueKey));
    }
}