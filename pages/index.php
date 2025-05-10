<?php
session_start();
// If the user is logged in redirects to the home page
//if (isset($_SESSION['account_loggedin'])) {
//    header("location :$_SESSION[employeeType]");
//    exit;
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rota System Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/general_css.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<div class="wrapper">
    <div class="container-fluid">

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

            <button class="btn" type="submit">Login</button>

        </form>

    </div>

    <div class="container-fluid">
        <p>Manager TEST USER: Username: MANAGERTEST Password: managertest</p>
        <p>Employee TEST USER: Username: EMPLOYEETEST Password: employeetest</p>
    </div>
</div>
</body>
</html>