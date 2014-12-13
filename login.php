<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="js/jquery-2.1.1.min.js"></script>
</head>
<body>
	
	<div id="login-container">
		<h3 id="title">Title of the forum here</h3>
		<div class="login-container-main" id="login">
			<h3>Sign in</h3>
			<form>
				<input type="text" name="username" placeholder="Username" />
				<input type="password" name="password" placeholder="Password" />
				<input type="submit" value="Login" />
				<input type="checkbox" name="remember" id="remember" /><label for="remeber">Remember me ?</label>
			</form>
		</div>
		<div class="login-container-main" id="register" style="display: none;">
			<h3>Sign up</h3>
			<form action="" method="post">
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
	</div>

    <?php
        include './register.php';
    ?>
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