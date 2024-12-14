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
        <div class="container-sm bg-light text-center">
            <h1>Vehicle Registration</h1>
            <p>Enter your registration number to check its validity</p>
            <form action="./search-by-num.php" method="post">
                <div class=" mb-3">
                    <input type="text" class="form-control" placeholder="Registration number" name="search" aria-describedby="basic-addon1">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>

        </div>
    </main>
</body>

</html>