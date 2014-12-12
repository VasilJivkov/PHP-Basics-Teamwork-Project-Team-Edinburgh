<?php 
	$title = 'index';
	include './include/header.html';
 ?>

 <!-- BODY START -->

<?php 
	$_SESSION['is_logged'] = false;
	if ($_SESSION['is_logged'] === true) {
		# code...
	} else {
		echo '<a href="register.php" title="">Register Here</a>';
	}
 ?>
 <!-- BODY END -->

<?php 
	include './include/footer.html';
?>