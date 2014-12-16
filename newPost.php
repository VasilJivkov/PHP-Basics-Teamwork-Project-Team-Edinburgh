<?php

require_once 'config/config.php';

require_once './lib/database.php';

session_start();
if ($_SESSION['loggedIn'] == false) {
    die('You must be logged in order to create a new post.');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>New post</title>
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
		</div>
		<div id="right">
			<section>
				<header><h3>New post:</h3></header>
				<form action="" method="post">
					<label>Heading</label>
					<input type="text" name="heading" />
					<label>Content</label>
					<textarea rows="10" cols="30" name="content"></textarea>
					<label>Category</label>
					<select name="category">
                        <?php
                        $db = new DB();
                        $query = $db->get_results('SELECT * FROM categories');

                        if (!$query) {
                            die('Error in database.');
                        } else {
                            foreach ($query as $row) {
                                echo '<option value="'.$row->Type.'">'.$row->Type.'</option>';
                            }
                        }
                        ?>
					</select>
					<input type="submit" value="Add">
				</form>
			</section>
		</div>
		<footer>
			<em>&copy; Team Edinburgh & SoftUni</em>
		</footer>
	</div>
</body>
</html>

<?php
if (!empty($_POST['heading']) &&
    !empty($_POST['content']) &&
    !empty($_POST['category'])) {

    $heading = htmlspecialchars($_POST['heading']);
    $content = htmlspecialchars($_POST['content']);
    $category = htmlspecialchars($_POST['category']);
    // AUTHOR!
    //start validation of the new post input
    if (strlen($heading) < 4) {
    	echo '<div class="newPostForumError">The heading is too small</div>';
    	return;
    }
    if (strlen($heading) > 100) {
    	echo '<div class="newPostForumError">The heading is too small</div>';
    	return;
    }
    if (strlen($content) < 5) {
    	echo '<div class="newPostForumError">The content is too small</div>';
    	return;
    }
    if (strlen($content) > 1000) {
    	echo '<div class="newPostForumError">The content is too big</div>';
    	return;
    }
    //end validation of the new post input


    $sql = 'INSERT INTO posts (heading, author, content, category, date) VALUES ("' . $db->escape($heading) . '", "'.
        $db->escape($_SESSION['username']).'",
        "' .$db->escape($content). '", "' .$db->escape($category). '", "'.date_format(new DateTime(), 'd-m-Y').'")';

    $db->query($sql);
    header('location:index.php');
}

?>