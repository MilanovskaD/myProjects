<?php

require_once('./Classes/Search.php');

$searchObj = new Search();
$search = $searchObj->search();

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['search'])) {

    if (!$search) {
        echo "No results found";
        exit();
    }
} else {
    header('Location: registrations.php');
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Registration system</title>
</head>

<body>
    <nav class="bg-light">
        <h6 class="d-flex justify-content-between align-items-center p-2">Vehicle registration
            <a href="./login.php" class="btn btn-primary">Login</a>
        </h6>
    </nav>
    <main>
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

                </tr>
            </thead>
            <tbody>
                <?php foreach ($search as $searchData) : ?>

                    <tr>
                        <th scope="row"><?= $searchData['id'] ?></th>
                        <td><?= $searchData['vehicle_model'] ?></td>
                        <td><?= $searchData['vehicle_type'] ?></td>
                        <td><?= $searchData['vehicle_chassis'] ?></td>
                        <td><?= $searchData['vehicle_production_year'] ?></td>
                        <td><?= $searchData['reg_num'] ?></td>
                        <td><?= $searchData['fuel_type'] ?></td>
                        <td><?= $searchData['reg_date'] ?></td>

                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </main>
</body>

</html>