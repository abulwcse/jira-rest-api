<?php

namespace Jira\Authentication;


class BasicAuthenticationService implements AuthenticationServiceInterface
{
    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $password;

    /**
     * BasicAuthenticationService constructor.
     * @param string $userName
     * @param string $password
     */
    public function __construct($userName, $password)
    {
        $this->userName = $userName;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getAuthOption()
    {
        return [
            'auth' => [
                $this->getUserName(),
                $this->getPassword()
            ]
        ];
    }
}