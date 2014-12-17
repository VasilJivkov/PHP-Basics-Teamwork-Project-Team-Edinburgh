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
<!-- add header -->
<header id="mainHeader">
    <div>
        <a href="index.php" id="innerHeaderDiv">
            <h1>chmod 777</h1>
            <h3>Where your ulimit is unlimited</h3>
        </a>
    </div>
</header>
<!-- end add header -->
<div id="main-container">
    <div id="left">
        <section>
            <div class="menu"><h3>Menu</h3></div>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
            </ul>
        </section>
        <section>
            <div class="menu"><h3>Categories</h3></div>
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
                <h2><a href="./post.php?post=<?php echo $post->post_id ?>"><?php echo $post->heading ?></a></h2>
                <h3>Visits: <?php echo $post->visits ?></h3>
                <em>posted by <?php echo $post->author ?> on <?php echo $post->date ?> in
                    <a href="<?php echo 'index.php?category=' . $post->category ?>"><?php echo $post->category ?></a></em>
            </article>

        <?php
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