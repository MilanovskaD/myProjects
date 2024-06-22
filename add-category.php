<?php
require_once('./Classes_PHP/Category.php');

session_start();
$categoryObj = new Category();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['title'])) {

        $categoryObj->addCategories();
    } else {

        $_SESSION['empty_fields'] = 'Please fill all required fields.';
    }
    header('Location: manage-categories.php');
}
