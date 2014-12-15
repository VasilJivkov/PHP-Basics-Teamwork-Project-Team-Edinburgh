<?php 
	$title = 'index';
    $style = 'index.css';

    require_once 'config/config.php';

	include './phpScripts/header.php';
    require_once './lib/database.php';
 ?>

 <!-- BODY START -->

<? include './phpScripts/navigation.php'; ?>

<?php 
	$_SESSION['is_logged'] = false;
	if ($_SESSION['is_logged'] === true) {
		// code
	} else {
		echo '<a href="login.php" title="">Register Here</a>';
	}
 ?>

<div id="right">
    <div id="actions">
        <button>+ Create new post</button>
    </div>
</div>

<?php
    $db = new DB();

    $sql = "SELECT * FROM posts";
    $result = $db->get_results($sql);

    foreach ($result as $post) { ?>
    
         <article>
            <header><a href="./post.php?post=<?php echo $post->post_id ?>"><?php echo $post->heading ?></a></header>
            <em>posted by <a href="javascript:;"><?php echo $post->author ?></a> on 14.12.2014 in <a href="javascript:;"><?php echo $post->category ?></a></em>
        </article>
       
        <?php
    }
?>
 <!-- BODY END -->

<?php 
	include './phpScripts/footer.html';
?>