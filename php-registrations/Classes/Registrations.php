<?php

require_once('DB.php');

class Registrations
{
    private DB $db;

    public function __construct()
    {
        $this->db = new DB();
    }


    public function insertData(): bool
    {
        $connection = $this->db->getConnection();

        $query = 'INSERT INTO registrations (vehicle_model, vehicle_chassis, reg_num, reg_date, vehicle_type, vehicle_production_year, fuel_type) 
        VALUES (:vehicle_model, :vehicle_chassis, :reg_num, :reg_date, :vehicle_type, :vehicle_production_year, :fuel_type);';

        try {
            $stmt = $connection->prepare($query);

            $stmt->bindParam(':vehicle_model', $_POST['vehicle_model']);
            $stmt->bindParam(':vehicle_chassis', $_POST['vehicle_chassis']);
            $stmt->bindParam(':reg_num', $_POST['reg_num']);
            $stmt->bindParam(':reg_date', $_POST['reg_date']);
            $stmt->bindParam(':vehicle_type', $_POST['vehicle_type']);
            $stmt->bindParam(':vehicle_production_year', $_POST['vehicle_production_year']);
            $stmt->bindParam(':fuel_type', $_POST['fuel_type']);

            return $stmt->execute();
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') { // This is associated with SQL and database-related exceptions, indicating a constraint violation
                $_SESSION['noDuplicates'] = 'A record with the same chassis number already exists.';
            } else {
                $_SESSION['noDuplicates'] = 'Database error: ' . $e->getMessage();
            }

            return false;
        }
    }
    public function getData(): array
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT * FROM registrations;';
        $stmt = $connection->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteData($id): bool
    {
        $connection = $this->db->getConnection();
        $query = 'DELETE FROM registrations WHERE id = :id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateData(): bool
    {
        $connection = $this->db->getConnection();
        $data =  [
            'id' =>  $_GET['id'],
            'vehicle_model' =>  $_POST['vehicle_model'],
            'vehicle_chassis' =>  $_POST['vehicle_chassis'],
            'vehicle_production_year' =>  $_POST['vehicle_production_year'],
            'reg_num' =>  $_POST['reg_num'],
            'fuel_type' =>  $_POST['fuel_type'],
            'reg_date' =>  $_POST['reg_date']
        ];

        $query = 'UPDATE registrations SET
        vehicle_model = :vehicle_model,
        vehicle_chassis = :vehicle_chassis,
        vehicle_production_year = :vehicle_production_year,
        reg_num = :reg_num,
        fuel_type = :fuel_type,
        reg_date = :reg_date
        WHERE id = :id';

        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $stmt->bindParam(':vehicle_model', $data['vehicle_model'], PDO::PARAM_STR);
        $stmt->bindParam(':vehicle_chassis', $data['vehicle_chassis'], PDO::PARAM_STR);
        $stmt->bindParam(':vehicle_production_year', $data['vehicle_production_year'], PDO::PARAM_INT);
        $stmt->bindParam(':reg_num', $data['reg_num'], PDO::PARAM_STR);
        $stmt->bindParam(':fuel_type', $data['fuel_type'], PDO::PARAM_STR);
        $stmt->bindParam(':reg_date', $data['reg_date'], PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function extendRegistrationDate($id): bool
    {
        $connection = $this->db->getConnection();
        $regDate = $_POST['reg_date'];

        $query = 'UPDATE registrations SET
        reg_date = :reg_date
        WHERE id = :id';

        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':reg_date', $regDate, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function getDataById($id): array
    {
        $connection = $this->db->getConnection();
        $query = 'SELECT * FROM registrations WHERE id = :id LIMIT 1;';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }
}
