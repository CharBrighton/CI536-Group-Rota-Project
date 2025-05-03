<?php
//hides errors showing on the page but keep commented out for dev purposes
//error_reporting(0);
session_start();
if (!isset($_SESSION['account_loggedin'])) {
    header("location:index.php");
    exit;
}
if (isset($_SESSION['manager'])) {
    header("location:manager_index.php");
}
global $conn;
include "../conn/conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="../css/general_css.css" rel="stylesheet">
</head>

<body>
<div class="wrapper">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="employee_index.php">Logo (Employee Portal)</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="employee_rota.php">My Rota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="employee_timeoff.php">Time Off</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="employee_dayavailability.php">Day Availability</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logic/logout_logic.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <h1>Welcome, <?= htmlspecialchars($_SESSION['account_name'], ENT_QUOTES) ?> to the Scheduling Portal</h1>
        <p>Manage work, your way.</p>
        <p>This is your one-stop hub for all things scheduling. Here, you can:</p>
        <ul>
            <li>Use <strong>My Rota</strong> to stay up to date with upcoming shifts and view your previous shifts.</li>
            <li>Use<strong>Day Availability</strong> to show your preference so you can be scheduled when it works best.</li>
            <li>Use<strong>Time Off</strong> to quickly and easily request time off with real time status updates.</li>
        </ul>
        <p>Whether you're planning ahead or making a last-minute change, the tools you need are right here.</p>
    </div>
</div>
</body>
</html>