<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Vehicle models</title>
</head>

<body>
    <main>
        <div class="container-sm bg-light text-center">
            <h1>Add vehicle Model</h1>
            <form action="./add-model.php" method="post">
                <div class=" mb-3">
                    <input type="text" class="form-control" placeholder="Add new Vehicle model" name="vehicle_model" aria-describedby="basic-addon1">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </main>

</html>