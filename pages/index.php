<?php
session_start();
// If the user is logged in redirects to the home page
//if (isset($_SESSION['account_loggedin'])) {
//    header("location :$_SESSION[employeeType]");
//    exit;
//}
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

            <h1>Rota System Login</h1>

            <form action="../logic/authenticate.php" method="post" class="form login-form">

                <label class="form-label" for="username">Username</label>
                <div class="form-group">
                    <input class="form-input" type="text" name="username" placeholder="Username" id="username" required>
                </div>

                <label class="form-label" for="password">Password</label>
                <div class="form-group mar-bot-5">
                    <input class="form-input" type="password" name="password" placeholder="Password" id="password" required>
                </div>

                <button class="btn blue" type="submit">Login</button>


            </form>

        </div>

    <div><p>Manager TEST USER: Username: MANAGERTEST Password: managertest</p>
        <p>Employee TEST USER: Username: EMPLOYEETEST Password: employeetest</p></div>

    </body>
</html>