<?php

require_once('DB.php');

class Admin
{
    private DB $db;


    public function __construct()
    {
        $this->db = new DB();
    }


    public function findAdmin()
    {
        $connection = $this->db->getConnection();

        $query = 'SELECT * FROM admin WHERE username = :username;';
        $stmt = $connection->prepare($query);
        $stmt->execute(['username' => $_POST['username']]);
        $admin = $stmt->fetch();

        if (!$admin) {
            return false;
        }

        $hashedPassword = $admin['password'];

        if (password_verify($_POST['password'], $hashedPassword)) {
            return $admin;
        } else {
            return false;
        }
    }
}
