<?php

require_once('DB.php');

class Admin
{
    private DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }


    public function findAdmin($username, $password) {
        $connection = $this->db->getConnection();
        $query = 'SELECT * FROM admin WHERE username = :username';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $admin = $stmt->fetch();

        if (!$admin) {
            return false;
        }

        $hashedPassword = $admin['password'];
        return password_verify($password, $hashedPassword);
    }
}

