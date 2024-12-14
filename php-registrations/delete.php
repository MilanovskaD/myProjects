<?php

require_once('Classes/Registrations.php');

$registrationsObj = new Registrations();
$id = $_POST['id'];
$registrations = $registrationsObj->deleteData($id);


if (isset($_POST['id'])) {

    header('Location: registrations.php');
}
