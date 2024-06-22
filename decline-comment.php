<?php
include_once('Classes_PHP/Comments.php');
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $comment_id = intval($_POST['comment_id']);

    $comments = new Comments();
    $success = $comments->declineComment($comment_id);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
