<?php

require_once('DB.php');

class Search
{
    private DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function search()
    {
        $connection = $this->db->getConnection();
        $search = '%' . $_POST['search'] . '%';
        $query = 'SELECT * FROM registrations WHERE vehicle_model LIKE :search OR vehicle_chassis LIKE :search OR reg_num LIKE :search;';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':search', $search);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchByRegNum()
    {
        $connection = $this->db->getConnection();
        $search = '%' . $_POST['search'] . '%';
        $query = 'SELECT * FROM registrations WHERE reg_num LIKE :search;';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':search', $search);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
