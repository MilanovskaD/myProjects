<?php
require_once('./Classes_PHP/Book.php');

session_start();
$bookObj = new Book();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        !empty($_POST['category_id']) && !empty($_POST['book_title']) && !empty($_POST['author_id']) &&
        !empty($_POST['release_date']) && !empty($_POST['pages_num']) && !empty($_POST['img_url'])
    ) {

        $bookObj->addBooks();
    } else {

        $_SESSION['empty_fields'] = 'Please fill all required fields.';
    }

    header('Location: manage-books.php');
    exit;
}
