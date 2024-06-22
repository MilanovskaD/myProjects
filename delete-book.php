<?php
include_once ('Classes_PHP/Book.php');
$bookObj = new Book;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $book_id = $_POST['id'];

    $bookObj->deleteBook($book_id);

    header('Location: manage-books.php');
    exit;
} else {

    echo 'Invalid request.';
}