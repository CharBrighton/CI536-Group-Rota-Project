<?php
session_start();
if (!isset($_SESSION['account_loggedin'])) {
    header("location:index.php");
    exit;
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1">
    <title>Register</title>
</head>
<body>
<h1>Account succesfully registered</h1>
<a class="nav-link" href="index.php">Return</a>

</body>
</html>