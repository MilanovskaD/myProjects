<?php
require_once('./Classes/Admin.php');
session_start();


$password = $_POST['password'];
$username = $_POST['username'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($password) || empty($username)) {
        $_SESSION['emptyFields'] = 'Please enter both username and password';
        header('Location: login.php');
    } else {
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
        $_SESSION['logged'] = 'Admin logged';
        $adminObj = new Admin();
        $admin = $adminObj->findAdmin();

        if (!$admin) {
            $_SESSION['wrongCredentials'] = 'Wrong credentials';
            header('Location: login.php');
        } else {
            header('Location: registrations.php');
        }
        return;
    }
}
