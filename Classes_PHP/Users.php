<?php

require_once "DB.php";
class Users
{
    private DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function insertUsers($username, $email, $password): bool
    {
        $connection = $this->db->getConnection();
        $query = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);


        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);

        return $stmt->execute();
    }
//    public function getUsers($username, $password) : bool {
//        $connection = $this->db->getConnection();
//        $query = 'SELECT * FROM users WHERE username = :username';
//        $stmt = $connection->prepare($query);
//        $stmt->bindParam(':username', $username);
//        $stmt->execute();
//        $user = $stmt->fetch();
//
//        if (!$user) {
//            return false;
//        }
//
//        $hashedPassword = $user['password'];
//        return password_verify($password, $hashedPassword);
//    }
    public function getUsers($username, $password) {
        $connection = $this->db->getConnection();
        $query = 'SELECT * FROM users WHERE username = :username';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        $hashedPassword = $user['password'];
        if (password_verify($password, $hashedPassword)) {
            return $user;
        }

        return false;
    }

    public function getUsername($username)
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT username FROM users WHERE username = :username';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getUserDataById($userId)
    {
        $connection = $this->db->getConnection();
        $stmt = $connection->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bindParam(1, $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}


