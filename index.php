<?php
require_once('Classes_PHP/Book.php');
require_once('Classes_PHP/Category.php');

session_start();
//header("Cache-Control: no-cache, must-revalidate");
//header("Pragma: no-cache");
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
//disabled cache memory because its causing browser problems



$bookObj = new Book();

$books = $bookObj->getAllBooks();

$categoryObj = new Category();
$categories = $categoryObj->getCategoriesInfo();

// var_dump($books);
?>

<!doctype html>
<html lang="en">

<head>
    <title>Brainster Library</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./favicon/favicon-32x32.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/3c18f363e4.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <?php
        //      session_start();

        if (isset($_SESSION['loggedUser'])) {
            echo '<script>';
            echo 'Swal.fire({';
            echo '  position: "center",';
            echo '  icon: "success",';
            echo '  title: "' . $_SESSION['loggedUser'] . '",';
            echo '  showConfirmButton: false,';
            echo '  timer: 2000';
            echo '});';
            echo '</script>';
            unset($_SESSION['loggedUser']);
        }

        ?>

        <!-- Nav bar elements -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Brainster Library</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <?php
                        if (isset($_SESSION['userUsername'])) {
                            echo '<li class="nav-item pt-3 px-3">' . '<i class="fa-solid fa-circle-user fa-lg"></i> ' . $_SESSION['userUsername'] . '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link active btn btn-primary mt-2" href="logout.php">Log out</a>' . '</li>';
                        } else {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link active btn btn-primary me-lg-2 mt-2" href="#signupForm" id="signupBtn">Sign up</a>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link active btn btn-primary mt-2" href="#loginForm" id="loginBtn">Login</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sign Up modal -->
        <div id="signupModal" class="custom-modal">
            <div class="custom-modal-dialog">
                <div class="custom-modal-content">
                    <div class="custom-modal-header">
                        <h5 class="custom-modal-title">Sign Up</h5>
                        <button type="button" class="custom-close" id="closeSignup">&times;</button>
                    </div>
                    <div class="custom-modal-body">
                        <form action="./signup.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Enter username</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="mb-2">
                                <label for="passwordSignup" class="form-label">Enter password</label>
                                <input type="password" id="passwordSignup" name="password" class="form-control showPassword" placeholder="Password">
                                <input id="showPswSignup" type="checkbox" onclick="showPassword()" class="mt-1">
                                <label for="showPswSignup">Show password</label>
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Enter your email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Your Email">
                            </div>
                            <?php
                            //                  session_start();
                            if (isset($_SESSION['error'])) {
                                echo '<div id="signupError" class="text-danger">' . $_SESSION['error'] . '</div>';
                                unset($_SESSION['error']);
                            }
                            if (isset($_SESSION['success'])) {
                                echo '<div id="signupSuccess" class="text-success">' . $_SESSION['success'] . '</div>';
                                unset($_SESSION['success']);
                            }
                            ?>
                            <div class="custom-modal-footer">
                                <button type="submit" class="btn btn-primary">Sign up</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Login modal -->
        <div id="loginModal" class="custom-modal">
            <div class="custom-modal-dialog">
                <div class="custom-modal-content">
                    <div class="custom-modal-header">
                        <h5 class="custom-modal-title">Login</h5>
                        <button type="button" class="custom-close" id="closeLogin">&times;</button>
                    </div>
                    <div class="custom-modal-body">
                        <form action="./login.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Enter your username</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                            </div>

                            <div class="mb-2">
                                <label for="password" class="form-label">Enter your password</label>
                                <input type="password" id="password" name="password" class="form-control showPassword" placeholder="Password">
                                <input id="showPswLogin" type="checkbox" onclick="showPassword()" class="mt-1">
                                <label for="showPswLogin">Show password</label>
                            </div>
                            <?php

                            if (isset($_SESSION['empty_fields'])) {
                                echo '<div id="loginError" class="text-danger">' . $_SESSION['empty_fields'] . '</div>';
                                unset($_SESSION['empty_fields']);
                            } elseif (isset($_SESSION['wrong_credentials'])) {
                                echo '<div id="loginError" class="text-danger">' . $_SESSION['wrong_credentials'] . '</div>';
                                unset($_SESSION['wrong_credentials']);
                            }
                            if (isset($_SESSION['success'])) {
                                echo '<div id="loginSuccess" class="text-success">' . $_SESSION['success'] . '</div>';
                                unset($_SESSION['success']);
                            }
                            ?>

                            <div class="custom-modal-footer">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="background d-flex align-items-end pb-5">
            <div class="quote mb-5">
                There is no friend as loyal as a book!
            </div>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="./main.js"></script>
</body>

</html>