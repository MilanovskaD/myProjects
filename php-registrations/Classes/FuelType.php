<?php

require_once('DB.php');

class FuelType
{
    private DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function getFuelType(): array
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT * FROM fuel_types;';
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $fuelTypesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $fuelTypesData;
    }
}
