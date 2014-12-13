<?php
	$title = 'register';
	include './include/header.html';
    include './include/connection.php';

// BODY START 
// 1.Chek if user is already login, check the cookie
	$_SESSION['is_logged'] = false;
	if ($_SESSION['is_logged'] === false) {
?>

<?php
	// check if the form is send
	if (isset($_POST['username']) &&
		isset($_POST['password']) &&
		isset($_POST['repeat-password']) &&
		isset($_POST['email'])) {
		//put the information into variables
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			$passwordRepeat = trim($_POST['repeat-password']);
			$email = trim($_POST['email']);
			// validation of the input
			if (strlen($username) < 4 || strlen($username > 30)) {
				echo '<div id="error">Invalid Username</div>';
                return;
			}
			if (strlen($password) < 4) {
                echo '<div id="error">The password is too short</div>';
                return;
			}
			if ($password != $passwordRepeat) {
                echo '<div id="error">The passwords doesn\'t match</div>';
                return;
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo '<div id="error">Invalid email</div>';
                return;
			}

			//connect to the database
			//check if loginName and email is already exist in database

			$sql = 'SELECT COUNT(*) as cnt FROM users WHERE user_name="'.addslashes($username).'"OR email="'.addslashes($email).'"';
			$query = mysqli_query($connection, $sql);
			$row =mysqli_fetch_assoc($query);

			// if user doesn't exist put info into database
			if ($row['cnt'] == 0) {
                $sql = 'INSERT INTO users (user_id,user_name,password,email) VALUES ("","' .
                    mysqli_real_escape_string($connection, $username) . '","' .
                    md5($password) . '","' .
                    mysqli_real_escape_string($connection, $email).'")';
                echo $sql;

                mysqli_query($connection, $sql);
				if (mysqli_error($connection)) {
					echo "<h1>Error</h1>";
					echo mysqli_error($connection);
				} else {
                    echo '<p>You have registered successfully!</p>';
				}
			} else {
				echo '<div id="error">User Name or Email already exists</div>';
			}

		}
} else {
	echo '<div id="error">You are already logged in.</div>';
}
?>

