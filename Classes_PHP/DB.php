<?php

class DB
{
    private PDO $connection;


    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=brainster_library';
        $username = 'root';
        $password = '';
        $pdo = new PDO($dsn, $username, $password);

        $this->connection = $pdo;
    }


    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
