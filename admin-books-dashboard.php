<?php
require_once('Classes_PHP/Book.php');
require_once('Classes_PHP/Comments.php');


$bookObj = new Book();
$books = $bookObj->getAllBooks();

$book_id = $_GET['id'] ?? null;

$selected_book = null;
if ($book_id !== null) {
    foreach ($books as $book) {
        if ($book['id'] == $book_id) {
            $selected_book = $book;
            break;
        }
    }
}

$commentsObj = new Comments();
$comments = $commentsObj->getCommentsByBookId($book_id);


?>



<!doctype html>
<html lang="en">

<head>
    <title>Admin booksdashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./favicon/favicon2-32x32.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/3c18f363e4.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Brainster Library</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">


                        <li class="nav-link"><a href="./admin-panel.php" class="btn btn-secondary">Back to home page</a></li>

                        <?php
                        session_start();
                        if (isset($_SESSION['adminUsername'])) {
                            echo '<li class="nav-item pt-3 px-3">' . '<i class="fa-solid fa-user-gear fa-lg"></i> ' . $_SESSION['adminUsername'] . '</li>';
                        }
                        ?>


                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="height-100">
        <div class="row mt-5">
            <div class="col-lg-6 col-md-12 mb-3">
                <div class="book-container">
                    <div class="book">
                        <img src="<?= htmlspecialchars($selected_book['img_url']) ?>" alt="book image" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="book-details">
                    <h3>Book title: <?= htmlspecialchars($selected_book['book_title']) ?></h3>
                    <h5>By: <?= htmlspecialchars($selected_book['full_name']) ?></h5>
                    <h5>Release date: <?= htmlspecialchars($selected_book['release_date']) ?></h5>
                    <h5>Category: <?= htmlspecialchars($selected_book['title']) ?></h5>
                    <h6>Author short bio:</h6>
                    <p><?= htmlspecialchars($selected_book['short_bio']) ?></p>

                </div>
            </div>
        </div>

        <div class="comments-section w-75 mx-auto mt-5">
            <?php

            foreach ($comments as $comment) {
                echo '<div class="comment d-flex mb-3 flex-column">';
                echo '<p class="mb-3 me-3"><strong>' . htmlspecialchars($comment['username']) . ':</strong> <span class="comment-content">' . htmlspecialchars($comment['content']) . '</span></p>';
            }

            ?>

        </div>
    </main>



    <footer>
        <blockquote id="quote" class="text-center py-4 mb-0 randomQuote"></blockquote>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="./main.js"></script>
</body>

</html>