<?php
require_once('./Classes_PHP/Admin.php');
require_once('./Classes_PHP/Users.php');
require_once('./Classes_PHP/Validations.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $validations = new Validations();
    $user = new Users();


    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['error'] = 'All fields are required.';
    } else {

        if (!$validations->usernameValidity($username)) {
            $_SESSION['error'] = 'Username is not valid. Only alphanumeric characters are allowed.';
        } elseif ($validations->usernameExists($username)) {
            $_SESSION['error'] = 'Username already exists.';
        } elseif ($validations->emailExists($email)) {
            $_SESSION['error'] = 'Email already exists.';
        } elseif (!$validations->checkPasswordStrength($password)) {
            $_SESSION['error'] = 'Password is not strong enough. It must contain at least one lowercase letter, one uppercase letter, one number, one special character and at least 8 characters long.';
        } else {

            if ($user->insertUsers($username, $email, $password)) {
                $_SESSION['success'] = 'User registered successfully.';
            } else {
                $_SESSION['error'] = 'User registration failed.';
            }
        }
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
