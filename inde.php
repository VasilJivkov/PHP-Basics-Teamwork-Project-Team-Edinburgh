<?php 
	$title = 'index';
    $style = 'index.css';

    require_once 'config/config.php';

	include './phpScripts/header.php';
    require_once './lib/database.php';
 ?>

 <!-- BODY START -->

<?php 
	$_SESSION['is_logged'] = false;
	if ($_SESSION['is_logged'] === true) {
		// code
	} else {
		echo '<a href="login.php" title="">Register Here</a>';
	}
 ?>

<?php
    $db = new DB();

    $sql = "SELECT * FROM posts";
    $result = $db->get_results($sql);

    foreach ($result as $post) { ?>
        <section>
            <a href="./post.php?post=<?php echo $post->post_id ?>">
                <div class="heading"><?php echo $post->heading ?></div>
                <div class="author"><?php echo $post->author ?></div>
                <div class="category"><?php echo $post->category ?></div>
            </a>
        </section>
        <?php
    }

?>
 <!-- BODY END -->

<?php 
	include './phpScripts/footer.html';
?>