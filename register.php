<?php
session_start();
// If the user is logged in, redirect to the home page
if (isset($_SESSION['account_loggedin'])) {
	header('Location: home.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Register</title>
	</head>
	<body>
		<div class="login">

			<h1>Member Register</h1>

			<form action="register-process.php" method="post" class="form login-form">

				<label class="form-label" for="username">Username</label>
				<div class="form-group">
					<input class="form-input" type="text" name="username" placeholder="Username" id="username" required>
				</div>

				<label class="form-label" for="email">Email</label>
				<div class="form-group">
					<input class="form-input" type="email" name="email" placeholder="Email" id="email" required>
				</div>

				<label class="form-label" for="password">Password</label>
				<div class="form-group mar-bot-5">
					<input class="form-input" type="password" name="password" placeholder="Password" id="password" autocomplete="new-password" required>
				</div>

				<button class="btn" type="submit">Register</button>

				<p class="register-link">Already have an account? <a href="index.php" class="form-link">Login</a></p>

			</form>

		</div>
	</body>
</html>