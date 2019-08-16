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
        return $this->client->get('/rest/api/2/search?jql='.urlencode($jql));
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
        return $this->client->get('/rest/api/2/issue/'. urlencode($issueKey));
    }


    /**
     * @param $issueKey
     * @return object
     */
    public function getIssueChangeLog($issueKey)
    {
        return $this->client->get('/rest/api/2/issue/' . urlencode($issueKey) . '/changelog');
    }


    /**
     * @param $issueKey
     * @param $data
     * @return object
     */
    public function updateIssue($issueKey, $data)
    {
        return $this->client->put('/rest/api/2/issue/' . urlencode($issueKey), [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($data)
        ]);
    }


    /**
     * @param $data
     * @return object
     */
    public function createIssue($data)
    {
        return $this->client->post('/rest/api/2/issue', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($data)
        ]);
    }


    /**
     * @param $issueKey
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteIssueIncludingItsSubTask($issueKey)
    {
        return $this->client->delete('/rest/api/2/issue/' . urlencode($issueKey) . '?deleteSubtasks=true' );
    }

    /**
     * @param string $issueKey
     * @param bool $expand
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAllComments($issueKey, $expand)
    {
        return $this->client->get('/rest/api/2/issue/' . urlencode($issueKey) . '/comment?expand' . ($expand ? 'true' : 'false'));
    }

    /**
     * @param string $issueKey
     * @param array $comment
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addComment($issueKey, $comment)
    {
        return $this->client->post('/rest/api/2/issue/' . urlencode($issueKey) . '/comment', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($comment)
        ]);
    }

    /**
     * @param string $issueKey
     * @param int $commentId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getComment($issueKey, $commentId)
    {
        return $this->client->get('/rest/api/2/issue/' . urlencode($issueKey) . '/comment/' . urlencode($commentId));
    }

    /**
     * @param string $issueKey
     * @param int $commentId
     * @param array $comment
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateComment($issueKey, $commentId, $comment)
    {
        return $this->client->post('/rest/api/2/issue/' . urlencode($issueKey) . '/comment/' . urlencode($commentId), [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($comment)
        ]);
    }

    /**
     * @param string $issueKey
     * @param int $commentId
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteComment($issueKey, $commentId)
    {
        return $this->client->delete('/rest/api/2/issue/' . urlencode($issueKey) . '/comment/' . urlencode($commentId));
    }
}
