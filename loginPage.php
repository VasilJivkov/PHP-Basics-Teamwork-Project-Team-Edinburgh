<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="js/jquery-2.1.1.min.js"></script>
</head>
<body>
    <?php
        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
            header('location:index.php');
        }
    ?>
	
	<div id="login-container">
        <button onclick="location.href='index.php'">Home</button>
		<h3 id="title">Title of the forum here</h3>
		<div class="login-container-main" id="login">
			<h3>Sign in</h3>
			<form action="login.php" method="post">
				<input type="text" name="username" placeholder="Username" />
				<input type="password" name="password" placeholder="Password" />
				<input type="submit" value="Login" />
			</form>
		</div>
		<div class="login-container-main" id="register" style="display: none;">
			<h3>Sign up</h3>
			<form action="register.php" method="post">
				<input type="text" name="username" placeholder="Username" />
				<input type="email" name="email" placeholder="Email" />
				<input type="password" name="password" placeholder="Password" />
				<input type="password" name="repeat-password" placeholder="Repeat password" />
				<input type="submit" value="Register" onclick="clearErrors()" />
			</form>
		</div>
		<div id="changeForm">
			<a href="#">Create an Account</a>
			<a href="#" style="display: none">Login</a>
		</div>
        <?php
            if (!empty($_GET['error'])) {
                $error = htmlspecialchars($_GET['error']);
                echo '<div id="error">' .$error.'</div>';
            } elseif (!empty($_GET['success'])) {
                $success = htmlspecialchars($_GET['success']);
                echo '<div id="success">' .$success.'</div>';
            }
        ?>

	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#changeForm a').click(function() {
				$('#register').slideToggle();
				$('#login').slideToggle();
				$('#changeForm a').toggle();
			});
		});

        function clearErrors() {
            var errors = document.getElementById('error');
            errors.innerText = "";
        }
	</script>
</body>
</html>