<?php
require_once('./Classes_PHP/Admin.php');
require_once('./Classes_PHP/Users.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['empty_fields'] = 'All fields are required.';
    } else {
        $admin = new Admin();
        if ($admin->findAdmin($username, $password)) {
            $_SESSION['loggedAdmin'] = 'Admin logged';
            $_SESSION['adminUsername'] = $username;
            header('Location: admin-panel.php');
            exit();
        }

        $user = new Users();
        $userData = $user->getUsers($username, $password);
        if ($userData) {
            $_SESSION['loggedUser'] = 'User logged';
            $_SESSION['userUsername'] = $username;
            $_SESSION['userId'] = $userData['id'];
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['wrong_credentials'] = 'Invalid username or password.';
        }
    }
    header('Location: index.php');
    exit();
}
