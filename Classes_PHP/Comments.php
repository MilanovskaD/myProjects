<?php

include_once('DB.php');
class Comments
{
    private DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function addComment($content, $book_id, $user_id): bool
    {
        $connection = $this->db->getConnection();
        $query = 'INSERT INTO comments (content, book_id, user_id) VALUES (:content, :book_id, :user_id)';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':book_id', $book_id);
        $stmt->bindParam(':user_id', $user_id);

        return $stmt->execute();
    }

    public function getCommentsByBookId($book_id)
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE book_id = :book_id AND is_deleted = 0 ORDER BY comments.id DESC';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':book_id', $book_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getComments()
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT * FROM comments WHERE is_approved IS NULL AND is_deleted = 0';
        $stmt = $connection->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getApprovedComments()
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT * FROM comments WHERE is_approved = 1 AND is_deleted = 0';
        $stmt = $connection->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getApprovedCommentsByBookId($book_id)
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE book_id = :book_id AND is_approved = 1 AND is_deleted = 0 ORDER BY comments.id DESC';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':book_id', $book_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDeclinedComments()
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT * FROM comments WHERE is_approved = 0 AND is_deleted = 0';
        $stmt = $connection->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function deleteComment($comment_id): bool
    {
        $connection = $this->db->getConnection();
        $query = 'UPDATE comments SET is_deleted = 1 WHERE id = :comment_id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateComment($comment_id, $content): bool
    {
        $connection = $this->db->getConnection();
        $query = 'UPDATE comments SET content = :content WHERE id = :comment_id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function approveComment($comment_id): bool
    {
        $connection = $this->db->getConnection();
        $query = 'UPDATE comments SET is_approved = 1 WHERE id = :comment_id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function declineComment($comment_id): bool
    {
        $connection = $this->db->getConnection();
        $query = 'UPDATE comments SET is_approved = 0 WHERE id = :comment_id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getCommentById($comment_id)
    {
        $connection = $this->db->getConnection();
        $stmt = $connection->prepare("SELECT * FROM comments WHERE id =? AND is_approved = 1 AND is_deleted = 0");
        $stmt->bindParam(1, $comment_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
