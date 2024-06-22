<?php

include_once('DB.php');


class Category
{

    private DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function getCategoriesInfo()
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT * FROM categories WHERE is_deleted = 0';
        $stmt = $connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function addCategories()
    {
        {
            $connection = $this->db->getConnection();
            $query = 'INSERT INTO categories (title) 
        VALUES (:title)';
            $stmt = $connection->prepare($query);
            $stmt->bindParam(':title', $_POST['title']);

            $stmt->execute();

        }
    }

    //soft delete technique
    public function deleteCategory($id)
    {
        $connection = $this->db->getConnection();
        $query = 'UPDATE categories SET is_deleted = 1 WHERE id = :id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    function getCategoryDataById($categoryId)
    {
        $connection = $this->db->getConnection();
        $stmt = $connection->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->bindParam(1, $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function editCategory($id)
    {
        $connection = $this->db->getConnection();
        $query = "UPDATE categories SET 
        title = :title WHERE id = :id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $_POST['title']);

        $stmt->execute();


    }
}