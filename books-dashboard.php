<?php
require_once('Classes_PHP/Book.php');
require_once('./Classes_PHP/Comments.php');


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
?>


<!doctype html>
<html lang="en">

<head>
    <title>Books Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="shortcut icon" href="./favicon/favicon-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="./style.css">
    <script src="https://kit.fontawesome.com/3c18f363e4.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="body">
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Brainster Library</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <?php
                        session_start();
                        if (isset($_SESSION['userUsername'])) {
                            echo '<li class="nav-item pt-3 px-3">' . '<i class="fa-solid fa-circle-user fa-lg"></i> ' . $_SESSION['userUsername'] . '</li>';
                            echo '<li class="nav-item">';
                        }
                        ?>
                        <li class="nav-link"><a href="./index.php" class="btn btn-secondary">Back to home page</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="height-100">
        <div class="row mt-5 w-75 mx-auto">
            <div class="col-lg-6 col-md-12 mb-3">
                <div class="book-container">
                    <div class="book">
                        <img src="<?= htmlspecialchars($selected_book['img_url']) ?>" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 ">
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
        <?php if (isset($_SESSION['userId'])) : ?>
            <div class="comments-section w-75 mx-auto mt-5">
                <i class="mb-3">Comments:</i>
                <?php
                $commentsObj = new Comments();
                $comments = $commentsObj->getCommentsByBookId($selected_book['id']);

                foreach ($comments as $comment) {
                    echo '<div class="comment d-flex align-items-center mb-3">';
                    echo '<p class="mb-0 me-3"><strong>' . htmlspecialchars($comment['username']) . ':</strong> <span class="comment-content">' . htmlspecialchars($comment['content']) . '</span></p>';

                    if ($comment['user_id'] == $_SESSION['userId']) {
                        // Delete button
                        echo '<form action="./delete-comment.php" method="POST" class="me-2">';
                        echo '<input type="hidden" name="comment_id" value="' . htmlspecialchars($comment['id']) . '">';
                        echo '<input type="hidden" name="book_id" value="' . htmlspecialchars($selected_book['id']) . '">';
                        echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($_SESSION['userId']) . '">';
                        echo '<button type="submit" class="btn btn-link p-0 m-0 align-baseline" title="Delete Comment">';
                        echo '<i class="fa-solid fa-trash-can"></i>';
                        echo '</button>';
                        echo '</form>';

                        // Edit button
                        echo '<button class="btn btn-link p-0 m-0 align-baseline edit-comment me-2" title="Edit Comment" data-comment-id="' . htmlspecialchars($comment['id']) . '">';
                        echo '<i class="fa-solid fa-pen-to-square"></i>';
                        echo '</button>';

                        // Approval status
                        if ($comment['is_approved'] == 0) {
                            echo '<small class="text-secondary bold">Your comment is not approved yet</small>';
                        } elseif ($comment['is_approved'] == 1) {
                            echo '<small class="text-success bold">Your comment is approved</small>';
                        } else {
                            echo '<small class="text-danger bold">Your comment is declined</small>';
                        }
                    }
                    echo '</div>';
                }
                ?>
            </div>
            <div class="w-75 mx-auto">
                <form id="commentForm" action="./add-comment.php" method="POST">
                    <div class="mb-3">
                        <label for="comments" class="form-label">Add comment</label>
                    </div>
                    <div class="mb-3">
                        <textarea name="content" id="comments" class="form-control" placeholder="Add your comment here"></textarea>
                        <input type="hidden" name="book_id" value="<?= htmlspecialchars($selected_book['id']) ?>">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['userId']) ?>">
                        <input type="hidden" name="comment_id" id="comment_id" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
            <div class="w-50 mx-auto">
                <i>Your notes:</i>
                <p id="notes"></p>
                <label for="notes-content" class="form-label">Leave a note here</label>
                <textarea id="notes-content" class="form-control"></textarea>
                <button id="add-note" class="btn btn-primary mt-3" data-book-id="<?= htmlspecialchars($selected_book['id']) ?>" data-user-id="<?= htmlspecialchars($_SESSION['userId']) ?>">Add</button>
            </div>
        <?php else : ?>
            <div class="comments-section w-75 mx-auto mt-5">


                <?php
                $commentsObj = new Comments();
                $comments = $commentsObj->getApprovedCommentsByBookId($selected_book['id']);
                // 
                if (!$comments) {
                    echo "<p>There are no comments</p>";
                } else {
                    echo "<i class \"mb-2\" >Comments:</i>";
                }

                foreach ($comments as $comment) {
                    echo '<div class="comment d-flex align-items-center mb-3">';
                    echo '<p class="mb-0 me-3"><strong>' . htmlspecialchars($comment['username']) . ':</strong> <span class="comment-content">' . htmlspecialchars($comment['content']) . '</span></p>';
                    echo '</div>';
                }
                ?>
            </div>
        <?php endif; ?>


        <?php
        //= $_SESSION['userId']
        ?>


    </main>


    <footer class="books-dashboard-footer mt-4">
        <blockquote id="quote" class="text-center py-4 mb-0 randomQuote"></blockquote>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="./main.js"></script>
</body>

</html>