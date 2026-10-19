<?php

class Usuario
{
    private string $username;
    private string $passwd;

    public function __construct(string $username, string $passwd)
    {
        $this->username = $username;
        $this->passwd = $passwd;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPasswd(): string
    {
        return $this->passwd;
    }
}
