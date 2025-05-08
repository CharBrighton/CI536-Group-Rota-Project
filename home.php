<?php
session_start();
// redirect to login
if (!isset($_SESSION['account_loggedin'])) {
    header('Location: pages/manager_index.php');
    exit;
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1">
        <title>Home</title>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>

        <header class="header">

            <div class="wrapper">

                <h1>Website Title</h1>
                
                <nav class="menu">
                    <a href="home.php">Home</a>
                    <a href="logic/logout_logic.php">
                        Logout
                    </a>
                </nav>

            </div>

        </header>

        <div class="content">

            <div class="page-title">
                <div class="wrap">
                    <h2>Home</h2>
                    <p>Welcome back, <?=htmlspecialchars($_SESSION['account_name'], ENT_QUOTES)?>!</p>
                </div>
            </div>

            <div class="block">

                <p>This is the home page. You are logged in!</p>

            </div>
            
        </div>

    </body>
</html>
