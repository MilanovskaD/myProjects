<?php
require_once "Classes_PHP/DB.php";

class Notes
{
    private DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function addNotes($note_content, $book_id, $user_id): bool
    {
        $connection = $this->db->getConnection();
        $query = 'INSERT INTO notes (note_content, user_id ,book_id) VALUES (:note_content, :user_id,:book_id)';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':note_content', $note_content);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':book_id', $book_id);

        return $stmt->execute();
    }

    public function getNotes($user_id, $book_id)
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT * FROM notes WHERE user_id = :user_id AND book_id = :book_id AND is_deleted = 0';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':book_id', $book_id);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function deleteNote($note_id): bool
    {
        $connection = $this->db->getConnection();
        $query = 'UPDATE notes SET is_deleted = 1 WHERE id = :note_id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':note_id', $note_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateNote($note_id, $note_content): bool
    {
        $connection = $this->db->getConnection();
        $query = 'UPDATE notes SET note_content = :note_content WHERE id = :note_id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':note_content', $note_content, PDO::PARAM_STR);
        $stmt->bindParam(':note_id', $note_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
