<?php

require_once('DB.php');

class VehicleType
{
    private DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function getVehicleType(): array
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT * FROM vehicle_types;';
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $vehicleTypesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $vehicleTypesData;
    }
}
