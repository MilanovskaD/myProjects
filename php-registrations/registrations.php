<?php
require_once('./includes.php');

$vehicleModelsObj = new VehicleModel();
$vehicleModels = $vehicleModelsObj->getVehicleModels();

$vehicleTypesObj = new VehicleType();
$vehicleTypes = $vehicleTypesObj->getVehicleType();

$fuelTypesObj = new FuelType();
$fuelTypes = $fuelTypesObj->getFuelType();

$registrationsObj = new Registrations();
$registrations = $registrationsObj->getData();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Registration</title>
</head>

<body>
    <nav class="bg-light d-flex justify-content-between align-items-center p-2">
        <h6>Vehicle registration</h6>
        <div>
            <a href="./vehicle-model.php" class="btn btn-primary">Add new model</a>
            <a href="./login.php" class="btn btn-primary">Logout</a>
        </div>
    </nav>
    <main><?php
            session_start();
            if (isset($_SESSION['logged'])) {
                echo '<div class="alert alert-success mt-2" role="alert">' . $_SESSION['logged'] . '</div>';
                unset($_SESSION['logged']);
            } ?>
        <div class="container-sm bg-light text-center">
            <?php
            if (isset($_SESSION['empty'])) {
                echo '<div class="alert alert-danger mt-2" role="alert">' . $_SESSION['empty'] . '</div>';
                unset($_SESSION['empty']);
            } ?>
            <h1>Vehicle Registration</h1>

            <form action="./register.php" method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-4">

                            <label for="vehicle_model" class="form-label">Vehicle model</label>
                            <select name="vehicle_model" id="vehicle_model" class="form-select">

                                <?php foreach ($vehicleModels as $vehicleModel) : ?>
                                    <option value="<?= $vehicleModel['vehicle_model'] ?>"><?= $vehicleModel['vehicle_model'] ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="vehicle_chassis" class="form-label">Vehicle chassis number</label>
                            <input type="text" name="vehicle_chassis" id="vehicle_chassis" class="form-control">

                            <?php
                            if (isset($_SESSION['noDuplicates'])) {
                                echo '<small class="text-danger mt-2">' . $_SESSION['noDuplicates'] . '</small>';
                                unset($_SESSION['noDuplicates']);
                            } ?>

                        </div>

                        <div class="mb-3">
                            <label for="reg_num" class="form-label">Vehicle registration number</label>
                            <input type="text" name="reg_num" id="reg_num" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="reg_date" class="form-label">Registered to</label>
                            <input type="date" name="reg_date" id="reg_date" class="form-control">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-4">
                            <label for="vehicle_type" class="form-label">Vehicle type</label>
                            <select name="vehicle_type" id="vehicle_type" class="form-select">

                                <?php foreach ($vehicleTypes as $vehicleType) : ?>
                                    <option value="<?= $vehicleType['vehicle_type'] ?>"><?= $vehicleType['vehicle_type'] ?></option>
                                <?php endforeach ?>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="vehicle_production_year" class="form-label">Vehicle production year</label>
                            <input type="number" min="1950" max="2030" name="vehicle_production_year" id="vehicle_production_year" class="form-control">
                        </div>

                        <div class="mb-4">
                            <label for="fuel_type" class="form-label">Fuel type</label>
                            <select name="fuel_type" id="fuel_type" class="form-select">

                                <?php foreach ($fuelTypes as $fuelType) : ?>
                                    <option value="<?= $fuelType['fuel_type'] ?>"><?= $fuelType['fuel_type'] ?></option>
                                <?php endforeach ?>

                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary d-inline-block my-4 w-100">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
            <form action="./search.php" method="post" class="d-flex justify-content-end">
                <div class=" mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search" aria-describedby="basic-addon1">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary ms-4">Search</button>
                </div>

            </form>
            <div class="mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Vehicle model</th>
                            <th scope="col">Vehicle type</th>
                            <th scope="col">Vehicle chassis number</th>
                            <th scope="col">Vehicle Production year</th>
                            <th scope="col">Registration number</th>
                            <th scope="col">Fuel type</th>
                            <th scope="col">Registration to</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registrations as $registration) : ?>
                            <?php
                            $expirationDate = new DateTime($registration['reg_date']);
                            $currentDate = new DateTime();
                            $rowClass = '';


                            if ($expirationDate <= $currentDate) {
                                $rowClass = 'text-danger';
                            } elseif ($expirationDate->modify('-1 month') <= $currentDate) {
                                $rowClass = 'text-warning';
                            }
                            ?>
                            <tr>
                                <th scope="row"><?= $registration['id'] ?></th>
                                <td class="<?= $rowClass ?>"><?= $registration['vehicle_model'] ?></td>
                                <td class="<?= $rowClass ?>"><?= $registration['vehicle_type'] ?></td>
                                <td class="<?= $rowClass ?>"><?= $registration['vehicle_chassis'] ?></td>
                                <td class="<?= $rowClass ?>"><?= $registration['vehicle_production_year'] ?></td>
                                <td class="<?= $rowClass ?>"><?= $registration['reg_num'] ?></td>
                                <td class="<?= $rowClass ?>"><?= $registration['fuel_type'] ?></td>
                                <td class="<?= $rowClass ?>"><?= $registration['reg_date'] ?></td>

                                <td colspan="4">
                                    <?php if ($rowClass) : ?>
                                        <div class="d-flex">
                                            <form action="./delete.php" method="post">
                                                <button type="submit" class="btn btn-sm btn-danger mx-1" name="delete">Delete</button>
                                                <input type="hidden" name="id" value="<?= $registration['id'] ?>">
                                            </form>

                                            <form action="./edit.php?id=<?= $registration['id'] ?>" method="post">
                                                <button type="submit" class="btn btn-sm btn-warning  mx-1">Edit</button>
                                            </form>

                                            <form action="./extend.php?id=<?= $registration['id'] ?>" method="post">
                                                <button type="submit" class="btn btn-sm btn-success mx-1">Extend</button>
                                            </form>
                                        </div>
                                    <?php endif ?>

                                    <?php if (!$rowClass) : ?>
                                        <div class="d-flex">
                                            <form action="./delete.php" method="post">
                                                <button type="submit" class="btn btn-sm btn-danger mx-1" name="delete">Delete</button>
                                                <input type="hidden" name="id" value="<?= $registration['id'] ?>">
                                            </form>

                                            <form action="./edit.php?id=<?= $registration['id'] ?>" method="post">
                                                <button type="submit" class="btn btn-sm btn-warning mx-1">Edit</button>
                                            </form>
                                        </div>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>
        </div>
    </main>
</body>

</html>