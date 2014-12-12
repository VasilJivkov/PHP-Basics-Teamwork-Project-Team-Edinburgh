<?php
	$title = 'register';
	include './include/header.html';

// BODY START 
// 1.Chek if user is already login, check the cookie
	$_SESSION['is_logged'] = false;
	if ($_SESSION['is_logged'] === false) {
?>
<form action="register.php" method="POST">
	<label for="loginName">Login firstName:</label>
	<input type="text" name="loginName"><br>
	<label for="pass">Password:</label>
	<input type="password" name="pass"><br>
	<label for="passRepeat">Repeat Password:</label>
	<input type="password" name="passRepeat"><br>
	<label for="email">Email:</label>
	<input type="email" name="email"><br>
	<label for="firstName">First firstName:</label>
	<input type="text" name="firstName"><br>
	<label for="secondName">Second firstName</label>
	<input type="text" name="secondName"><br>
	<input type="submit" value="Submit">
</form>
<?php
	// check if the form is send
	if (isset($_POST['loginName']) && !empty($_POST['loginName']) &&
		isset($_POST['pass']) && !empty($_POST['pass']) &&
		isset($_POST['passRepeat']) && !empty($_POST['passRepeat']) &&
		isset($_POST['email']) && !empty($_POST['email']) &&
		isset($_POST['firstName']) && !empty($_POST['firstName']) &&
		isset($_POST['secondName']) && !empty($_POST['secondName'])
		) {
		//put the information into variables
			$loginName = trim($_POST['loginName']);
			$pass = trim($_POST['pass']);
			$passRepeat = trim($_POST['passRepeat']);
			$email = trim($_POST['email']);
			$firstName = trim($_POST['firstName']);
			$secondName = trim($_POST['secondName']);
			// validation of the input
			if (strlen($loginName) < 4 || strlen($loginName > 30)) {
				echo 'Invalid Login Name <br>';
			}
			if (strlen($pass) < 4) {
				echo 'The password is too short <br>';
			}
			if ($pass != $passRepeat) {
				echo 'The password doesn\'t match <br>';
			}
			// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			// 	echo 'Invalid Email <br>';
			// }  
			// if (preg_match("/[a-zA-Z]{3,16}/", $firstName)) {
			// 	echo 'Invalid First Name <br>';
			// }
			// if (preg_match("/[a-zA-Z]{3,16}/", $secondName)) {
			// 	echo 'Invalid Second Name <br>';
			// }

			//connect to the database
			//check if loginName and email is already exist in database
			function dbInit(){
				mysql_connect('localhost', 'root', 'dragoman')
				or die('error with connection to database');
				mysql_select_db('Forum');
			}
			dbInit();
			$sql = 'SELECT COUNT(*) as cnt FROM users WHERE loginName="'.addslashes($loginName).'"OR email="'.addslashes($email).'"';
			$res = mysql_query($sql);
			$row =mysql_fetch_assoc($res);
			// print_r($row);
			// if user doesn't exist put info into database
			if ($row['cnt'] == 0) {
				mysql_query('INSERT INTO users (loginName,pass,first_name,second_name,
					email,date_registered) VALUES ("'.addslashes($loginName).'","'.md5($pass).'","'.
					addslashes($firstName).'","'.addslashes($secondName).'","'.
					addslashes($email).'",'. time() .')');
				if (mysql_error()) {
					echo "<h1>EROOR!!!</h1>";
					echo mysql_error();
				} else {
					header('Location: index.php');
				}
			} else {
				echo 'User Name or Email already exist';
			}

		}
} else {
	header('Location: index.php');
	exit;
}
// BODY END
include './include/footer.html';
?>

