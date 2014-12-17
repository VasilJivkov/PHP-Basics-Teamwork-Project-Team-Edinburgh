<?php

if (empty($_GET['post'])) {
    header('location:index.php');
}

require_once 'config/config.php';

require_once './lib/database.php';

$post_id = (int)$_GET['post'];
$db = new DB();

$sql = "SELECT * FROM posts WHERE post_id=" . $post_id;
$result = $db->get_results($sql);

if (empty($result[0])) {
    die('Error in database.');
}

$visitsCount = (int)$result[0]->visits + 1;
$sql = "UPDATE posts SET visits='". $visitsCount ."' WHERE post_id='" . $post_id . "'";
$db->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $result[0]->heading ?></title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="js/jquery-2.1.1.min.js"></script>

</head>
<body>
<header id="mainHeader">
    <div>
        <a href="index.php" id="innerHeaderDiv">
            <h1>chmod 777</h1>
            <h3>Where your ulimit is unlimited</h3>
        </a>
    </div>
</header>
<div id="main-container">
    <div id="left">
        <section>
            <div><h3>Menu</h3></div>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
            </ul>
        </section>
        <section>
            <div><h3>Categories</h3></div>
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
                //show username on top right
                echo '<p id=showUsername>'.'Logged in as <span>' . $_SESSION['username'] .'</span></p>';
            }
            ?>
        </div>
        <article>
			<h1><a href="#"><?php echo $result[0]->heading ?></a></h1>
			<em>posted by <span class="user"><?php echo $result[0]->author ?></span> on <?php echo $result[0]->date ?> in
				<?php echo '<a href="index.php?category='.$result[0]->category.'">'.$result[0]->category.'</a>' ?></em>
			<p id="content"><?php echo $result[0]->content ?></p>
			</article>
        <form method="post" action="" id="add-comment">

        <h3>Responses</h3>
        <?php

        $sql = "SELECT * FROM comments WHERE post_related='" . $result[0]->post_id . "'";

        $responses = $db->get_results($sql);


        if (count($responses) == 0) {
            echo '<div>No responses yet</div>';
        } else {
            foreach ($responses as $response) { ?>
                <article class="comment">
                    <em>replied by <span class="user"><?php echo $response->author ?></span> on <?php echo $response->date ?></em>
                    <p><?php echo $response->content ?></p>
                </article>
            <?php
            }

        }
        ?>

        <form id="add-comment">
			<h3>Add a new response</h3>
			<textarea rows="8" name="comment"></textarea>
			<button type="submit">Add comment</button>
		</form>
        <?php
        if (isset($_POST['comment']) && !empty($_POST['comment'])) {

            if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                $comment = htmlspecialchars($_POST['comment']);
                $username = htmlspecialchars($_SESSION['username']);

                if (strlen($comment) < 4) {
                    echo '<div id="error"> The comment is too short</div>';
                    return;
                } elseif (strlen($comment) > 1000) {
                    echo '<div id="error"> The comment is too long</div>';
                    return;
                }

                $sql = "INSERT INTO comments (post_related, author, content, date) VALUES ('" . $result[0]->post_id . "','" .
                   $db->escape($username) . "','" . $db->escape($comment) . "','" . date_format(new DateTime(), 'd-m-Y') . "'" . ")";

                $db->query($sql);
                echo '<div id="success"> You have commented the post successfully</div>';
                header('location:#');

            } else {
                echo '<div id="error"> You must be logged in in order to post a comment</div>';
            }
        }

        ?>
    </div>
</div>
    <footer>
        <em>&copy; Team Edinburgh @ <a href="https://softuni.bg">Software University</a></em>
        <div id="badges">
            <a href="https://github.com/mihayloff/PHP-Basics-Teamwork-Project-Team-Edinburgh" title="Team GitHub">
                <img src="./pics/GitHub.png" alt="">
            </a>
        </div>
    </footer>
</body>
</html>

