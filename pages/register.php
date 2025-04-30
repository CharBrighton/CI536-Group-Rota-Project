<?php
session_start();

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

                <label class="form-label" for="firstname">First Name</label>
                <div class="form-group">
                    <input class="form-input" type="text" name="firstname" placeholder="john" id="firstname" required>
                </div>
                <label class="form-label" for="lastname">Last Name</label>
                <div class="form-group">
                    <input class="form-input" type="text" name="lastname" placeholder="smith" id="lastname" required>
                </div>
                <label class="form-label" for="firstname">Date of Birth</label>
                <div class="form-group">
                    <input class="form-input" type="date" name="date"  id="date" required>
                </div>
				<label class="form-label" for="email">Email</label>
				<div class="form-group">
					<input class="form-input" type="email" name="email" placeholder="Email" id="email" required>
				</div>

				<label class="form-label" for="password">Password</label>
				<div class="form-group">
					<input class="form-input" type="password" name="password" placeholder="Password" id="password" autocomplete="new-password" required>
				</div>
                <label class="form-label" for="emplyeeType">Check if manager</label>
                <div class="form-group">
                    <input class="form-input" type="checkbox" name="employeeType" id="employeetype" value="1">
                </div>

                <label class="form-label" for="payrate">Date of Birth</label>
                <div class="form-group">
                    <input class="form-input" type="text" name="payrate"  id="payrate" required>
                </div>
				<button class="btn" type="submit">Register</button>

				<p class="register-link">Already have an account? <a href="index.php" class="form-link">Login</a></p>

			</form>

		</div>
	</body>
</html>