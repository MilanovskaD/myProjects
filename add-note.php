<?php

require_once 'Classes_PHP/Notes.php';

session_start();

header('Content-Type: application/json');

if (!empty($_POST['note_content']) && !empty($_POST['book_id']) && !empty($_POST['user_id'])) {
    $noteContent = $_POST['note_content'];
    $bookId = $_POST['book_id'];
    $userId = $_POST['user_id'];


    $notesObj = new Notes();
    $result = $notesObj->addNotes($noteContent, $bookId, $userId);

    if ($result) {
        $response = [
            'status' => 'success',
            'message' => 'Note added successfully'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Failed to add note'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Note content, book ID, or user ID not provided in request'
    ];
}

echo json_encode($response);
