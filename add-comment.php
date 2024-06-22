<?php

include_once('Classes_PHP/Comments.php');
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = trim($_POST['content']);
    $book_id = intval($_POST['book_id']);
    $user_id = intval($_POST['user_id']);

    if (empty($content)) {
        $_SESSION['error'] = 'Comment content is required.';
        header('Location: books-dashboard.php?id=' . $book_id);
        exit();
    }

    $comments = new Comments();
    $success = $comments->addComment($content, $book_id, $user_id);

    if ($success) {
        $_SESSION['success'] = 'Comment added successfully.';
        header('Location: books-dashboard.php?id=' . $book_id);
        exit();
    } else {
        $_SESSION['error'] = 'Failed to add comment.';
        header('Location: books-dashboard.php?id=' . $book_id);
        exit();
    }
} else {

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
