<?php
session_start();
// If the user is logged in redirects to the home page
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
        <title>Login</title>
    </head>
    <body>
        <div class="login">

            <h1>Member Login</h1>

            <form action="authenticate.php" method="post" class="form login-form">

                <label class="form-label" for="username">Username</label>
                <div class="form-group">
                    <input class="form-input" type="text" name="username" placeholder="Username" id="username" required>
                </div>

                <label class="form-label" for="password">Password</label>
                <div class="form-group mar-bot-5">
                    <input class="form-input" type="password" name="password" placeholder="Password" id="password" required>
                </div>

                <button class="btn blue" type="submit">Login</button>

                <p class="register-link">Don't have an account? <a href="register.php" class="form-link">Register</a></p>

            </form>

        </div>
    </body>
</html>