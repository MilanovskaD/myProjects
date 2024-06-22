<?php

require_once 'Classes_PHP/Notes.php';


session_start();

header('Content-Type: application/json');

if (!empty($_POST['note_id'])) {
    $noteId = $_POST['note_id'];


    $notesObj = new Notes();
    $result = $notesObj->deleteNote($noteId);

    if ($result) {
        $response = [
            'status' => 'success',
            'message' => 'Note deleted successfully'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Failed to delete note'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Note ID not provided in request'
    ];
}

echo json_encode($response);
