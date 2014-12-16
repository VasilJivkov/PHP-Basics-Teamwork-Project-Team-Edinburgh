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
<section>
    <div class="heading"><?php echo $result[0]->heading ?></div>
    <div class="content"><?php echo $result[0]->content ?></div>
    <div class="category"><?php echo $result[0]->category ?></div>
    <div class="author"><?php echo $result[0]->author ?></div>
</section>


<?php
// body end

include './phpScripts/footer.html';

