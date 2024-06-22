<?php
include_once('./Classes_PHP/Author.php');

$authorId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$authorObj = new Author();
$authorsData = $authorObj->getAuthorDataById($authorId);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="shortcut icon" href="./favicon/favicon2-32x32.png" type="image/x-icon">

</head>

<body>
    <a href="admin-panel.php" class="btn btn-secondary m-3">Go back to admin panel</a>

    <div class="container mt-5">

        <form action="./update-author.php" method="post" class="mb-4">
            <h1 class="text-center">Edit Category</h1>
            <input type="hidden" name="id" value="<?= htmlspecialchars($authorId); ?>">
            <div class="mb-3">
                <label for="full_name" class="form-label">Title</label>
                <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Author Full Name" value="<?= $authorsData['full_name'] ?>">
            </div>
            <div class="mb-3">
                <label for="short_bio" class="form-label">Short Biography</label>
                <textarea id="short_bio" name="short_bio" class="form-control" placeholder="Author Short Biography"><?= $authorsData['short_bio'] ?></textarea>
            </div>

            <?php
            session_start();
            if (isset($_SESSION['empty_fields'])) {
                echo '<small" class="text-danger">' . $_SESSION['empty_fields'] . '<br>' . '</small>';
                unset($_SESSION['empty_fields']);
            }
            ?>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>




        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>