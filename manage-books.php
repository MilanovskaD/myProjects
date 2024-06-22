<?php
require_once "./Classes_PHP/Book.php";
include_once('./Classes_PHP/Category.php');
include_once('./Classes_PHP/Author.php');

$categoryObj = new Category;
$categoriesData = $categoryObj->getCategoriesInfo();

$authorObj = new Author();
$authorsData = $authorObj->getAuthorInfo();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="./favicon/favicon2-32x32.png" type="image/x-icon">

</head>

<body>
    <a href="admin-panel.php" class="btn btn-secondary m-3">Go back to admin panel</a>

    <div class="container mt-5">
        <form action="./add-book.php" method="post" class="mb-4">
            <h1 class="text-center">Add new Book</h1>

            <div class="mb-3">
                <label for="authorsDropdown" class="form-label">Select Categories</label>
                <select name="category_id" id="authorsDropdown" class="form-select">
                    <?php foreach ($categoriesData as $category) : ?>
                        <option value="<?= $category['id']; ?>"><?= $category['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="book_title" class="form-control" placeholder="Title">
            </div>
            <div class="mb-3">
                <label for="authorsDropdown" class="form-label">Select Authors</label>
                <select name="author_id" id="authorsDropdown" class="form-select">
                    <?php foreach ($authorsData as $author) : ?>
                        <option value="<?= $author['id']; ?>"><?= $author['full_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="release_date" class="form-label">Release Date</label>
                <input type="number" id="release_date" name="release_date" class="form-control" placeholder="Release Date">
            </div>

            <div class="mb-3">
                <label for="pages_num" class="form-label">Number of Pages</label>
                <input type="number" id="pages_num" name="pages_num" class="form-control" placeholder="Number of Pages">
            </div>

            <div class="mb-3">
                <label for="img_url" class="form-label">Image URL</label>
                <input type="text" id="img_url" name="img_url" class="form-control" placeholder="Image URL">
            </div>

            <?php
            session_start();
            if (isset($_SESSION['empty_fields'])) {
                echo '<small class="text-danger">' . $_SESSION['empty_fields']  . '</small>' . '<br>';
                unset($_SESSION['empty_fields']);
            }
            ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <h2 class="mb-4">Books Information</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book Title</th>
                    <th>Release Date</th>
                    <th>Pages Number</th>
                    <th>Author Full Name</th>
                    <th>Category Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $booksObj = new Book;
                $booksData = $booksObj->getAllBooks();

                foreach ($booksData as $book) {
                    echo "<tr>
              <td>{$book['id']}</td>
              <td>{$book['book_title']}</td>
              <td>{$book['release_date']}</td>
              <td>{$book['pages_num']}</td>
              <td>{$book['full_name']}</td>
              <td>{$book['title']}</td>
              <td>
                  <button class='btn btn-danger' onclick='confirmDelete({$book['id']})'>Delete</button>
                  <a href='./edit-book.php?id={$book['id']}' class='btn btn-warning'>Edit</a>
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
    <script src="./main.js"></script>
</body>

</html>