<?php
require_once 'Classes_PHP/Notes.php';

session_start();

header('Content-Type: application/json');

if (!empty($_SESSION['userId']) && !empty($_POST['book_id'])) {
    $userId = $_SESSION['userId'];
    $bookId = $_POST['book_id'];


    $notesObj = new Notes();
    $userNotes = $notesObj->getNotes($userId, $bookId);

    $response = [
        'status' => 'success',
        'notes' => $userNotes
    ];
} else {

    $response = [
        'status' => 'error',
        'message' => 'User ID or Book ID not provided in request',
        'debug' => [
            'post_data' => $_POST,
            'session_data' => $_SESSION
        ]
    ];
}

echo json_encode($response);
