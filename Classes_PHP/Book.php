<?php

include_once('DB.php');


class Book
{

    private DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function getBooksInfo()
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT * FROM books JOIN categories ON category_id = categories.id JOIN authors ON author_id = authors.id;';
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $booksData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $booksData;
    }

    public function getAllBooks()
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT books.id, books.category_id,books.book_title,books.author_id,books.release_date,books.pages_num,books.img_url, categories.title,categories.is_deleted,authors.full_name,authors.short_bio FROM books JOIN categories ON category_id = categories.id JOIN authors ON author_id = authors.id;';
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $booksData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $booksData;
    }


    public function addBooks()
    {
        $connection = $this->db->getConnection();
        $query = 'INSERT INTO books (category_id, book_title, author_id, release_date, pages_num, img_url) 
        VALUES (:category_id, :book_title, :author_id, :release_date, :pages_num, :img_url)';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':category_id', $_POST['category_id']);
        $stmt->bindParam(':book_title', $_POST['book_title']);
        $stmt->bindParam(':author_id', $_POST['author_id']);
        $stmt->bindParam(':release_date', $_POST['release_date']);
        $stmt->bindParam(':pages_num', $_POST['pages_num']);
        $stmt->bindParam(':img_url', $_POST['img_url']);
        $stmt->execute();

    }

    public function deleteBook($id)
    {
        $connection = $this->db->getConnection();
        $query = 'DELETE FROM books WHERE id = :id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    function getBookDataById($bookId)
    {
        $connection = $this->db->getConnection();
        $stmt = $connection->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->bindParam(1, $bookId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function editBook($id)
    {
        $connection = $this->db->getConnection();
        $query = "UPDATE books SET 
                 category_id = :category_id, book_title = :book_title, 
                 author_id = :author_id, release_date = :release_date, 
                 pages_num = :pages_num, img_url = :img_url WHERE id = :id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':category_id', $_POST['category_id']);
        $stmt->bindParam(':book_title', $_POST['book_title']);
        $stmt->bindParam(':author_id', $_POST['author_id']);
        $stmt->bindParam(':release_date', $_POST['release_date']);
        $stmt->bindParam(':pages_num', $_POST['pages_num']);
        $stmt->bindParam(':img_url', $_POST['img_url']);
        $stmt->execute();


    }
}