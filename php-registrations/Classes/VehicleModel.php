<?php

require_once('DB.php');


class VehicleModel
{
    private DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function getVehicleModels(): array
    {
        $connection = $this->db->getConnection();

        $query = 'SELECT * FROM vehicle_models;';
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $vehicleModelsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $vehicleModelsData;
    }

    public function addVehicleModel(): bool
    {
        $connection = $this->db->getConnection();
        $query = 'INSERT INTO vehicle_models (vehicle_model) VALUES (:vehicle_model)';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':vehicle_model', $_POST['vehicle_model']);
        return $stmt->execute();
    }
}
