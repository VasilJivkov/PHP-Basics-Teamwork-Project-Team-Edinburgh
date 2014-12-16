<?php

require_once './lib/database.php';
require_once 'config/config.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="js/jquery-2.1.1.min.js"></script>
</head>
<body>
<div id="main-container">
    <div id="left">
        <section>
            <header><h3>Menu</h3></header>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
            </ul>
        </section>
        <section>
            <header><h3>Categories</h3></header>
            <ul>
                <li>
                    <?php
                    $db = new DB();
                    $query = $db->get_results('SELECT * FROM categories');

                    if (!$query) {
                        die('Error in database.');
                    } else {
                        foreach ($query as $row) {
                            echo '<a href="index.php?category='.$row->Type.'">'.$row->Type.'</a>';
                        }
                    }
                    ?>
                </li>
            </ul>
        </section>
    </div>
    <div id="right">
        <div id="actions">
            <button onclick="location.href='newPost.php'">+ Create new post</button>
            <?php
            session_start();
            if (empty($_SESSION['loggedIn'])) {
                echo '<button onclick="location.href=\'loginPage.php\'">Login | Register</button>';
            } else {
                echo '<button onclick="location.href=\'logout.php\'">Logout</button>';
            }
            ?>
        </div>
        <?php
        $db = new DB();
        $sql;
        if (!empty($_GET['category'])) {
            $category = htmlspecialchars($_GET['category']);
            $sql = "SELECT * FROM posts WHERE category='".$category."'";
        } else {
            $sql = "SELECT * FROM posts";
        }

        $result = $db->get_results($sql);

        foreach ($result as $post) { ?>

            <article>
                <header><a href="./post.php?post=<?php echo $post->post_id ?>"><?php echo $post->heading ?></a></header>
                <em>posted by <?php echo $post->author ?> on <?php echo $post->date ?> in
                    <a href="<?php echo 'index.php?category=' . $post->category ?>"><?php echo $post->category ?></a></em>
            </article>

        <?php
        }
        ?>
    </div>
    <footer>
        <em>&copy; Team Edinburgh & SoftUni</em>
    </footer>
</div>
</body>
</html>