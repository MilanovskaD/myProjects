<?php
require_once "./Classes_PHP/Book.php";
include_once('./Classes_PHP/Category.php');
include_once('./Classes_PHP/Author.php');

$categoryObj = new Category;
$categoriesData = $categoryObj->getCategoriesInfo();

$authorObj = new Author();
$authorsData = $authorObj->getAuthorInfo();

$bookId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$bookObj = new Book();
$bookData = $bookObj->getBookDataById($bookId);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="shortcut icon" href="./favicon/favicon2-32x32.png" type="image/x-icon">


</head>

<body>

    <div class="container mt-5">

        <form action="./update-book.php" method="post" class="mb-4">
            <h1 class="text-center">Edit Book</h1>

            <input type="hidden" name="book_id" value="<?= htmlspecialchars($bookId); ?>">

            <div class="mb-3">
                <label for="categoriesDropdown" class="form-label">Select Categories</label>
                <select name="category_id" id="categoriesDropdown" class="form-select">
                    <?php foreach ($categoriesData as $category) : ?>
                        <option value="<?= htmlspecialchars($category['id']); ?>" <?= $category['id'] == $bookData['category_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($category['title']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="book_title" class="form-control" placeholder="Title" value="<?= htmlspecialchars($bookData['book_title']); ?>">
            </div>

            <div class="mb-3">
                <label for="authorsDropdown" class="form-label">Select Authors</label>
                <select name="author_id" id="authorsDropdown" class="form-select">
                    <?php foreach ($authorsData as $author) : ?>
                        <option value="<?= htmlspecialchars($author['id']); ?>" <?= $author['id'] == $bookData['author_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($author['full_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="release_date" class="form-label">Release Date</label>
                <input type="number" id="release_date" name="release_date" class="form-control" placeholder="Release Date" value="<?= htmlspecialchars($bookData['release_date']); ?>">
            </div>

            <div class="mb-3">
                <label for="pages_num" class="form-label">Number of Pages</label>
                <input type="number" id="pages_num" name="pages_num" class="form-control" placeholder="Number of Pages" value="<?= htmlspecialchars($bookData['pages_num']); ?>">
            </div>

            <div class="mb-3">
                <label for="img_url" class="form-label">Image URL</label>
                <input type="text" id="img_url" name="img_url" class="form-control" placeholder="Image URL" value="<?= htmlspecialchars($bookData['img_url']); ?>">
            </div>
            <input type="hidden" name="id" value="<?= $bookData['id'] ?>">

            <button type="submit" class="btn btn-primary">Edit Book</button>
        </form>