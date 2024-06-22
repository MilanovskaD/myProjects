<?php

require_once 'Classes_PHP/Notes.php';


session_start();

header('Content-Type: application/json');

if (!empty($_POST['note_id']) && !empty($_POST['note_content'])) {
    $noteId = $_POST['note_id'];
    $noteContent = $_POST['note_content'];


    $notesObj = new Notes();
    $result = $notesObj->updateNote($noteId, $noteContent);

    if ($result) {
        $response = [
            'status' => 'success',
            'message' => 'Note updated successfully'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Failed to update note'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Note ID or content not provided in request'
    ];
}

echo json_encode($response);
