<?php

// BODY START 
// 1.Chek if user is already login, check the cookie
    session_start();

	if ($_SESSION['loggedIn'] == false) {
        include './config/config.php';
        include './lib/database.php';
?>

<?php
	// check if the form is send
	if (isset($_POST['username']) &&
		isset($_POST['password']) &&
		isset($_POST['repeat-password']) &&
		isset($_POST['email'])) {
		//put the information into variables
			$username = htmlspecialchars($_POST['username']);
			$password = htmlspecialchars($_POST['password']);
			$passwordRepeat = htmlspecialchars($_POST['repeat-password']);
			$email = htmlspecialchars($_POST['email']);
			// validation of the input
			if (strlen($username) < 4 || strlen($username > 30)) {
                header('location:loginPage.php?error=Invalid+Username');
				return;
			}
			if (strlen($password) < 4) {
                header('location:loginPage.php?error=The+password+is+too+short');
				return;
			}
			if ($password != $passwordRepeat) {
                header('location:loginPage.php?error=The+passwords+don\'t+match');
				return;
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header('location:loginPage.php?error=Invalid+email');
				return;
			}

			//connect to the database
            $db = new DB();

			//check if loginName and email is already exist in database



			$sql = 'SELECT * FROM users WHERE user_name="'.$db->escape($username).
                '"OR email="'.$db->escape($email).'"';

            $result = $db->get_results($sql);

			// if user doesn't exist put info into database
			if (count($result) == 0) {
                $sql = 'INSERT INTO users (user_id,user_name,password,email) VALUES ("","' .
                    $db->escape($username) . '","' .
                    md5($password) . '","' .
                    $db->escape($email).'")';

                $db->query($sql);

                header('location:loginPage.php?success=You+have+registered+successfully');
			} else {
                header('location:loginPage.php?error=Username+or+Email+already+exists');
			}

		}
} else {
	header('location:index.php');
}
?>

