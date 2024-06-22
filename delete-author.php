<?php

include_once ('Classes_PHP/Author.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $author_id = $_POST['id'];
    $authorObj = new Author();
    $authorObj->deleteAuthor($author_id);

    header('Location: manage-authors.php');
    exit;
} else {

    echo 'Invalid request.';
}

