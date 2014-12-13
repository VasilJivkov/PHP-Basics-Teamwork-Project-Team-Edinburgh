<?php
if (isset($_POST['heading']) &&
    isset($_POST['content']) &&
    isset($_POST['category'])) {

    function hasCategory($connection, $category) {
        $query = mysqli_query($connection, 'SELECT * FROM categories');

        if (!$query) {
            die('Error in database.');
        } else {
            while ($row = $query->fetch_assoc()) {
                if ($row['Type'] == $category) {
                    return true;
                }
            }
            return false;
        }
    }

    $heading = htmlspecialchars($_POST['heading']);
    $content = htmlspecialchars($_POST['content']);
    $category = htmlspecialchars($_POST['category']);

    if (strlen($heading) < 4 || strlen($heading) > 50) {
        echo '<div id="error">The heading is too short or too long</div>';
        return;
    } else if (strlen($content) < 4 || strlen($heading) > 5000) {
        echo '<div id="error">The content is too short or too long</div>';
        return;
    } else if (!hasCategory($connection, $category)) {
        echo '<div id="error">There is no such category</div>';
        return;
    }

    $sql = 'SELECT COUNT(*) as cnt FROM posts WHERE heading="'.
        mysqli_real_escape_string($connection, $heading).'"';
    $query = mysqli_query($connection, $sql);
    $row =mysqli_fetch_assoc($query);

    if ($row['cnt'] == 0) {
        $author = 'none';
        $sql = 'INSERT INTO posts (post_id,heading,author,content,category) VALUES ("","' .
            mysqli_real_escape_string($connection, $heading) . '","' .
            mysqli_real_escape_string($connection, $author) . '","' .
            mysqli_real_escape_string($connection, $content) . '","' .
            mysqli_real_escape_string($connection, $category) .'")';

        mysqli_query($connection, $sql);
        if (mysqli_error($connection)) {
            echo '<div id="error">An error occurred on the database</div>';
            // echo mysqli_error($connection);
        } else {
            echo '<div id="success">You have created a new post successfully!</p>';
        }

    } else {
        echo '<div id="error">There is already a post with such heading</div>';
    }

}