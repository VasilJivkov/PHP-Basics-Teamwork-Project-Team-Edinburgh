<?php

require_once 'config/config.php';

require_once './lib/database.php';

session_start();
if ($_SESSION['loggedIn'] == false) {
    header('location:loginPage.php');
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
		</div>
		<div id="right">
			<section>
				<div><h3>New post:</h3></div>
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
    //start validation of the new post input
    if (strlen($heading) < 4) {
    	echo '<div class="newPostForumError">The heading is too short</div>';
    	return;
    }
    if (strlen($heading) > 100) {
    	echo '<div class="newPostForumError">The heading is too long</div>';
    	return;
    }
    if (strlen($content) < 5) {
    	echo '<div class="newPostForumError">The content is too short</div>';
    	return;
    }
    if (strlen($content) > 1000) {
    	echo '<div class="newPostForumError">The content is too long</div>';
    	return;
    }
	
	$sql = 'SELECT * FROM categories WHERE Type=\''.$category.'\'';
	$result = $db->get_results($sql);
	if (count($result) == 0) {
		echo '<div class="newPostForumError">There is no such category</div>';
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