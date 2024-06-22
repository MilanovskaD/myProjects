<?php
session_start();
require_once('./Classes_PHP/Author.php');

$authorObj = new Author();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['full_name']) && !empty($_POST['short_bio'])) {
        $authorObj->addAuthor();
    } else {
        $_SESSION['empty_fields'] = 'Please fill all required fields.';
    }
    header('Location: manage-authors.php');
    exit();
}
