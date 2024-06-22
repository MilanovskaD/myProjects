<?php
include_once ('Classes_PHP/Category.php');
$categoryObj = new Category();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $category_id = $_POST['id'];


    $categoryObj->editCategory($category_id);


    header('Location: manage-categories.php');
    exit;
} else {

    echo 'Invalid request.';
}
