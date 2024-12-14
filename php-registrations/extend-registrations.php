<?php

require_once('./Classes/Registrations.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['reg_date'])) {

    $id = $_GET['id'];

    $registrationsObj = new Registrations();
    $registrations = $registrationsObj->extendRegistrationDate($id);
} else {
    $_SESSION['emptyExtend'] = 'The input is required';
}

header('Location: extend.php');
return;
