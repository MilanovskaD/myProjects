<?php
session_start();
require_once('./Classes_PHP/Comments.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_id'], $_POST['user_id'], $_POST['content']) && $_POST['user_id'] == $_SESSION['userId']) {
    $comment_id = $_POST['comment_id'];
    $content = $_POST['content'];
    $commentsObj = new Comments();
    $commentsObj->updateComment($comment_id, $content);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    // Invalid request
    header('HTTP/1.1 403 Forbidden');
    echo 'You are not allowed to edit this comment.';
}