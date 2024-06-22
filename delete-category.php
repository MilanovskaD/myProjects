<?php

include_once ('Classes_PHP/Category.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $category_id = $_POST['id'];
    $categoryObj = new Category;
    $categoryObj->deleteCategory($category_id);

    header('Location: manage-categories.php');
    exit;
} else {

    echo 'Invalid request.';
}
