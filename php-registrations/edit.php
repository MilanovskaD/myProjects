<?php
require_once('./includes.php');

$vehicleModelsObj = new VehicleModel();
$vehicleModels = $vehicleModelsObj->getVehicleModels();

$vehicleTypesObj = new VehicleType();
$vehicleTypes = $vehicleTypesObj->getVehicleType();

$fuelTypesObj = new FuelType();
$fuelTypes = $fuelTypesObj->getfuelType();

$registrationsObj = new Registrations();
$id = $_GET['id'] ?? null;

$selectedRegistration = null;
if ($id) {
    $selectedRegistration = $registrationsObj->getDataById($id);
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit</title>
</head>

<body>
    <nav class="p-3">
        <a href="./registrations.php" class="btn btn-primary">Go back to registrations</a>
    </nav>
    <main>
        <div class="container-sm bg-light text-center">
            <?php
            session_start();
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger mt-2" role="alert">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            ?>
            <h1>Edit Registrations</h1>

            <form action="./edit-registrations.php?id=<?= $id ?>" method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-4">
                            <label for="vehicle_model" class="form-label">Vehicle model</label>
                            <select name="vehicle_model" id="vehicle_model" class="form-select">
                                <?php foreach ($vehicleModels as $vehicleModel) : ?>
                                    <option value="<?= $vehicleModel['vehicle_model'] ?>" <?= isset($selectedRegistration) && $selectedRegistration['vehicle_model'] === $vehicleModel['vehicle_model'] ? 'selected' : '' ?>>
                                        <?= $vehicleModel['vehicle_model'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="vehicle_chassis" class="form-label">Vehicle chassis number</label>
                            <input type="text" name="vehicle_chassis" id="vehicle_chassis" class="form-control" value="<?= $selectedRegistration['vehicle_chassis'] ?? '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="reg_num" class="form-label">Vehicle registration number</label>
                            <input type="text" name="reg_num" id="reg_num" class="form-control" value="<?= $selectedRegistration['reg_num'] ?? '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="reg_date" class="form-label">Registered to</label>
                            <input type="date" name="reg_date" id="reg_date" class="form-control" value="<?= $selectedRegistration['reg_date'] ?? '' ?>">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-4">
                            <label for="vehicle_type" class="form-label">Vehicle type</label>
                            <select name="vehicle_type" id="vehicle_type" class="form-select">
                                <?php foreach ($vehicleTypes as $vehicleType) : ?>
                                    <option value="<?= $vehicleType['vehicle_type'] ?>" <?= isset($selectedRegistration) && $selectedRegistration['vehicle_type'] === $vehicleType['vehicle_type'] ? 'selected' : '' ?>>
                                        <?= $vehicleType['vehicle_type'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="vehicle_production_year" class="form-label">Vehicle production year</label>
                            <input type="number" min="1950" max="2030" name="vehicle_production_year" id="vehicle_production_year" class="form-control" value="<?= $selectedRegistration['vehicle_production_year'] ?? '' ?>">
                        </div>

                        <div class="mb-4">
                            <label for="fuel_type" class="form-label">Fuel type</label>
                            <select name="fuel_type" id="fuel_type" class="form-select">
                                <?php foreach ($fuelTypes as $fuelType) : ?>
                                    <option value="<?= $fuelType['fuel_type'] ?>" <?= isset($selectedRegistration) && $selectedRegistration['fuel_type'] === $fuelType['fuel_type'] ? 'selected' : '' ?>>
                                        <?= $fuelType['fuel_type'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary d-inline-block my-4 w-100">Update</button>
                        </div>
                    </div>
                </div>
            </form>
</body>

</html>