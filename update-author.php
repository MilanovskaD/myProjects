<?php

include_once('Classes_PHP/Author.php');
$authorObj = new Author();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $author_id = $_POST['id'];

    $authorObj->editAuthor($author_id);

    header('Location: manage-authors.php');
    exit;
} else {

    echo 'Invalid request.';
}
