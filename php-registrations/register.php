<?php
require_once('./Classes/Registrations.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $data = [
        'vehicle_model' =>  $_POST['vehicle_model'],
        'vehicle_chassis' =>  $_POST['vehicle_chassis'],
        'vehicle_production_year' =>  $_POST['vehicle_production_year'],
        'registration_num' =>  $_POST['reg_num'],
        'fuel_type' =>  $_POST['fuel_type'],
        'registration_date' =>  $_POST['reg_date']
    ];

    foreach ($data as $key => $value) {
        if (empty($value)) {
            $errors[] = ucfirst(str_replace('_', ' ', $key)) . ' is required.';
        }
    }

    if (empty($errors)) {
        $registrationsObj = new Registrations();
        $result = $registrationsObj->insertData();

        if ($result) {
            header('Location: registrations.php');
            return;
        } else {
            $_SESSION['empty'] = 'Failed to insert data. Please try again.';
        }
    } else {
        $_SESSION['empty'] = implode('<br>', $errors);
    }
} else {
    $_SESSION['empty'] = 'Please submit the form.';
}


header('Location: registrations.php');
return;
