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

$title = $result[0]->heading;
$style = 'post.css';

include './phpScripts/header.php';

// body start
?>

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
            <header><a href="./post.php?post=<?php echo $post->post_id ?>"><?php echo $result[0]->heading ?></a></header>
            <em>posted by <?php echo $result[0]->author ?> on <?php echo $result[0]->date ?> in
                <a href="<?php echo 'index.php?category=' . $post->category ?>"><?php echo $result[0]->category ?></a></em>
                <p><?php echo $result[0]->content ?></p>
        </article>
    </div>
<?php
// body end

include './phpScripts/footer.html';

