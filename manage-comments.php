<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments Info</title>

    <link rel="shortcut icon" href="./favicon/favicon2-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <a href="admin-panel.php" class="btn btn-secondary m-3">Go back to home page</a>

    <div class="container mt-5">


        <button class="btn btn-primary my-3 float-end clearfix" id="switchTables">Switch to approved/declined comments table </button>
        <button class="btn btn-primary my-3 float-end clearfix" id="switchTablesBack">Switch back to pending comments table </button>


        <div id="pending-comments">
            <h2 class="mb-4"> Pending Comments</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Content</th>
                        <th>Book_id</th>
                        <th>User_id</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once('./Classes_PHP/Comments.php');
                    $commentsObj = new Comments();
                    $commentsData = $commentsObj->getComments();
                    //        $commentsDeclined = $commentsObj->getDeclinedComments();

                    foreach ($commentsData as $comment) {
                        echo "<tr>
                        <td>{$comment['id']}</td>
                        <td>{$comment['content']}</td>
                        <td>{$comment['book_id']}</td>
                        <td>{$comment['user_id']}</td>
                         <td>
                        <form action='./approve-comment.php' method='post' style='display: inline;'>
                      <input type='hidden' name='comment_id' value='{$comment['id']}'>
                      <button type='submit' class='btn btn-success' >Approve</button>
                      </form>

              </td>
                      </tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>

        <div id="approved-comments">

            <h2 class="mb-4">Approved comments</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Content</th>
                        <th>Book_id</th>
                        <th>User_id</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $comments = $commentsObj->getApprovedComments();

                    foreach ($comments as $comment) {
                        echo "<tr>
                        <td>{$comment['id']}</td>
                        <td>{$comment['content']}</td>
                        <td>{$comment['book_id']}</td>
                        <td>{$comment['user_id']}</td>
                         <td>
                        <form action='./decline-comment.php' method='post' style='display: inline;'>
                      <input type='hidden' name='comment_id' value='{$comment['id']}'>
                      <button type='submit' class='btn btn-danger' >Decline</button>
                      </form>

              </td>
                      </tr>";
                    }

                    ?>
                </tbody>
            </table>

            <h2 class="mb-4">Declined comments</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Content</th>
                        <th>Book_id</th>
                        <th>User_id</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $comments = $commentsObj->getDeclinedComments();

                    foreach ($comments as $comment) {
                        echo "<tr>
                        <td>{$comment['id']}</td>
                        <td>{$comment['content']}</td>
                        <td>{$comment['book_id']}</td>
                        <td>{$comment['user_id']}</td>
                         <td>
                        <form action='./approve-comment.php' method='post' style='display: inline;'>
                      <input type='hidden' name='comment_id' value='{$comment['id']}'>
                      <button type='submit' class='btn btn-success' >Approve</button>
                      </form>

              </td>
                      </tr>";
                    }

                    ?>
                </tbody>
            </table>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./main.js"></script>
</body>

</html>