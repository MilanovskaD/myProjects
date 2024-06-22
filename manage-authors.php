<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors Info</title>

    <link rel="shortcut icon" href="./favicon/favicon2-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <a href="admin-panel.php" class="btn btn-secondary m-3">Go back to admin panel</a>

    <div class="container mt-5">

        <h2 class="mb-4">Authors Information</h2>
        <form action="./add-author.php" method="post" class="mb-4">
            <h1 class="text-center">Add new Author</h1>

            <div class="mb-3">
                <label for="full_name" class="form-label">Title</label>
                <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Author Full Name">
            </div>
            <div class="mb-3">
                <label for="short_bio" class="form-label">Short Biography</label>
                <textarea id="short_bio" name="short_bio" class="form-control" placeholder="Author Short Biography"></textarea>
            </div>
            <?php
            session_start();
            if (isset($_SESSION['empty_fields'])) {
                echo '<small class="text-danger">' . $_SESSION['empty_fields'] . '<br>' . '</small>';
                unset($_SESSION['empty_fields']);
            }
            ?>

            <button type="submit" class="btn btn-primary my-2">Submit</button>

        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Short Bio</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once('./Classes_PHP/Author.php');
                $authorObj = new Author();
                $authorsData = $authorObj->getAuthorInfo();

                foreach ($authorsData as $author) {
                    echo "<tr>
                        <td>{$author['id']}</td>
                        <td>{$author['full_name']}</td>
                        <td>{$author['short_bio']}</td>
                         <td>
                        <form action='./delete-author.php' method='post' style='display: inline;'>
                      <input type='hidden' name='id' value='{$author['id']}'>
                      <button type='submit' class='btn btn-danger mb-2' onclick=\"return confirm('Are you sure you want to delete this author?');\">Delete</button>
                      </form>
                      <a href='./edit-author.php?id={$author['id']}' class='btn btn-warning'>Edit</a>
              </td>
                      </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>