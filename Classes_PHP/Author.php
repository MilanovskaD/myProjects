<?php

require_once('DB.php');


class Author
{

    private DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function getAuthorInfo()
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT * FROM authors ;';
        $stmt = $connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addAuthor()
    {
        $connection = $this->db->getConnection();
        $query = 'INSERT INTO authors (full_name, short_bio) 
        VALUES (:full_name, :short_bio)';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':full_name', $_POST['full_name']);
        $stmt->bindParam(':short_bio', $_POST['short_bio']);

        $stmt->execute();
    }

    public function deleteAuthor($id)
    {
        $connection = $this->db->getConnection();
        $query = 'DELETE FROM authors WHERE id = :id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    function getAuthorDataById($bookId)
    {
        $connection = $this->db->getConnection();
        $stmt = $connection->prepare("SELECT * FROM authors WHERE id = ?");
        $stmt->bindParam(1, $bookId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function editAuthor($id)
    {
        $connection = $this->db->getConnection();
        $query = 'UPDATE authors SET full_name = :full_name, short_bio = :short_bio WHERE id = :id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':full_name', $_POST['full_name']);
        $stmt->bindParam(':short_bio', $_POST['short_bio']);

        $stmt->execute();
    }
}
