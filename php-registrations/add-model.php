<?php

require_once('Classes/VehicleModel.php');


$vehicleModelObj = new VehicleModel();
$vehicleModel = $vehicleModelObj->addVehicleModel();

header('Location: registrations.php');
return;
