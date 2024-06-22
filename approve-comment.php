<?php
require_once('./Classes_PHP/Comments.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment_id = intval($_POST['comment_id']);

    $comments = new Comments();
    $success = $comments->approveComment($comment_id);

    if ($success) {
        $_SESSION['message'] = 'Comment approved successfully.';
    } else {
        $_SESSION['message'] = 'Failed to approve comment.';
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
