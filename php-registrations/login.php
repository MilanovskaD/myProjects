<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main>
        <div class="container-sm bg-light mt-3 ">
            <h1 class="text-center">Login</h1>
            <form action="./login-admin.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Your Username">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Your Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <?php
                session_start();

                if (isset($_SESSION['emptyFields'])) {
                    echo '<div class="alert alert-danger mt-2" role="alert">' . $_SESSION['emptyFields'] . '</div>';
                    unset($_SESSION['emptyFields']);
                }
                if (isset($_SESSION['wrongCredentials'])) {
                    echo '<div class="alert alert-danger mt-2" role="alert">' . $_SESSION['wrongCredentials'] . '</div>';
                    unset($_SESSION['wrongCredentials']);
                }
                ?>
            </form>
        </div>
    </main>

</body>

</html>