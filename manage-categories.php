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

        <form action="./add-category.php" method="post" class="mb-4">
            <h1 class="text-center">Add new Category</h1>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Title">
            </div>

            <?php
            session_start();
            if (isset($_SESSION['empty_fields'])) {
                echo '<small class="text-danger">' . $_SESSION['empty_fields'] . '<br>' . '</small>';
                unset($_SESSION['empty_fields']);
            }
            ?>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


        <h2 class="mb-4">Categories Information</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once('./Classes_PHP/Category.php');
                $categoryObj = new Category;

                $categoriesData = $categoryObj->getCategoriesInfo();

                foreach ($categoriesData as $category) {


                    echo "<tr>
                        <td>{$category['id']}</td>
                        <td>{$category['title']}</td>
                         <td>
                  <form action='./delete-category.php' method='post' style='display: inline;'>
                      <input type='hidden' name='id' value='{$category['id']}'>
                      <button type='submit' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this category?');\">Delete</button>
                  </form>
                  <a href='./edit-category.php?id={$category['id']}' class='btn btn-warning'>Edit</a>
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