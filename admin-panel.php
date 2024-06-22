<?php
require_once('Classes_PHP/Book.php');
require_once('Classes_PHP/Category.php');


$bookObj = new Book();
$books = $bookObj->getAllBooks();

// var_dump($books);

$categoryObj = new Category();
$categories = $categoryObj->getCategoriesInfo();
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
    session_start();

    if (isset($_SESSION['loggedAdmin'])) {
      echo '<script>';
      echo 'Swal.fire({';
      echo '  position: "center",';
      echo '  icon: "success",';
      echo '  title: "' . $_SESSION['loggedAdmin'] . '",';
      echo '  showConfirmButton: false,';
      echo '  timer: 1500';
      echo '});';
      echo '</script>';
      unset($_SESSION['loggedAdmin']);
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
          <ul class="navbar-nav ">
            <li class="nav-item mt-lg-0 mt-md-2">
              <a class="nav-link btn btn-blue" href="./manage-authors.php">Manage Authors</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-blue" href="./manage-categories.php">Manage Categories</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link btn btn-blue" href="./manage-books.php">Manage Books</a>
            </li>
            <li class="nav-item">
              <a href="./manage-comments.php" class="nav-link btn btn-blue">Manage Books Comments</a>
            </li>
            <?php
            if (isset($_SESSION['adminUsername'])) {
              echo '<li class="nav-item ">';
              echo '<a class="nav-link btn btn-blue " href="logout.php">Log out of admin panel</a>' . '</li>';
              echo '<li class="nav-item mx-2 mt-2">' . '<i class="fa-solid fa-user-gear fa-lg"></i> ' . $_SESSION['adminUsername'] . '</li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>

    <div class="background d-flex align-items-end pb-5">
      <div class="quote mb-5">
        There is no friend as loyal as a book!
      </div>
    </div>
  </header>
  <main class="main-index pt-3">
    <div class="checkbox-wrapper container w-50 mx-auto text-center py-3">
      <p class="text-center">Select one of the following book categories</p>
      <?php foreach ($categories as $category) : ?>
        <input type="checkbox" name="<?= strtolower($category['title']) ?>" id="filter-<?= strtolower($category['title']) ?>" hidden>
        <label for="filter-<?= strtolower($category['title']) ?>" class="labels"><?= $category['title'] ?></label>
      <?php endforeach; ?>
    </div>
    <div class="cards-container d-flex flex-wrap gap-4 justify-content-center mt-5 pb-5">
      <?php foreach ($books as $book) : ?>
        <div class="card <?= htmlspecialchars($book['title']) ?> zoom" style="width: 18rem;">
          <img src="<?= htmlspecialchars($book['img_url']) ?>" class="card-img-top" alt="book">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($book['book_title']) ?></h5>
            <p class="">Genre: <?= $book['title'] ?></p>
            <p class="card-text">By: <?= $book['full_name'] ?></p>
            <a href="./admin-books-dashboard.php?id=<?= htmlspecialchars($book['id']) ?>" class="btn btn-primary">View book details</a>
          </div>
        </div>
      <?php endforeach; ?>
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