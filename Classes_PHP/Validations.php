<?php
require_once('DB.php');

class Validations
{
    private DB $db;
    private Users $users;

    public function __construct()
    {
        $this->db = new DB();
        $this->users = new Users();
    }
    function checkPasswordStrength($password): bool
    {
        if (
            strlen($password) < 8 ||
            !preg_match('/[a-z]+/', $password) ||
            !preg_match('/[A-Z]+/', $password) ||
            !preg_match('/[0-9]+/', $password) ||
            !preg_match('/[!@#$%^&*]+/', $password)
        ) {
            return false;
        }

        return true;
    }

    function usernameValidity(string $username): bool
    {

        if (preg_match('/^[a-zA-Z0-9]+$/', $username)) {
            return true;
        }
        return false;
    }

    public function usernameExists(string $username): bool
    {
        $user = $this->users->getUsername($username);
        return !empty($user);
    }

    public function emailExists($email)
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT email FROM users WHERE email = :email';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
