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
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $result[0]->heading ?></title>
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
        <article>
				<header><a href="javascript:;">Problem with Visual Studio, C#</a></header>
				<em>posted by <a href="javascript:;">Administrator</a> on 14.12.2014 in <a href="javascript:;">C#</a></em>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</article>
        <form id="add-comment">
			<h3>Add comment</h3>
			<textarea rows="8"></textarea>
			<button type="submit">Add comment</button>
		</form>
    </div>
</body>
</html>

