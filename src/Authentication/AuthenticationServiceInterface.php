<?php

namespace Jira\Authentication;


interface AuthenticationServiceInterface
{
    /**
     * @return mixed
     */
    public function getAuthOption();
}