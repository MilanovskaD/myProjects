<?php
require_once('./includes.php');


$vehicleModelsObj = new VehicleModel();
$vehicleModels = $vehicleModelsObj->getVehicleModels();

$vehicleTypesObj = new VehicleType();
$vehicleTypes = $vehicleTypesObj->getVehicleType();

$fuelTypesObj = new FuelType();
$fuelTypes = $fuelTypesObj->getfuelType();

$registrationsObj = new Registrations();
$registrations = $registrationsObj->getData();

$id = $_GET['id'] ?? null;

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Extend registration</title>
</head>

<body>
    <nav class="p-3">
        <a href="./registrations.php" class="btn btn-primary">Go back to registrations</a>
    </nav>
    <main>
        <div class="container-sm bg-light text-center">
            <?php
            session_start();
            if (isset($_SESSION['emptyExtend'])) {
                echo '<div class="alert alert-danger mt-2" role="alert">' . $_SESSION['emptyExtend'] . '</div>';
                unset($_SESSION['emptyExtend']);
            }
            ?>

            <h1>Extend Registration</h1>

            <form action="./extend-registrations.php?id=<?= $id ?>" method="post">

                <?php foreach ($registrations as $registration) : ?>
                    <input type="text" name="id" value="<?= $registration['id'] ?>" hidden>
                <?php endforeach; ?>

                <div class="mb-3">
                    <input type="date" name="reg_date" id="reg_date" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Extend</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>