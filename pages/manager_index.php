<?php
//hides errors showing on the page but keep commented out for dev purposes
//error_reporting(0);
session_start();
if (!isset($_SESSION['account_loggedin'])) {
    header("location:index.php");
    exit;
}
if(!isset($_SESSION['manager'])){
    header("location:employee_index.php");
}

global $conn;
include "../conn/conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manager Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="../css/general_css.css" rel="stylesheet">
    <script src="../js/manager_index.js"></script>
</head>

<body>
<div class="wrapper">
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="manager_index.php">Logo (Manager Portal)</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="manager_rota.php">Full Rota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manager_shiftmanager.php">Manage Rota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manager_timeoff.php">Manage Time Off</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manager_register_employee.php">New Employee</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manager_my_employees.php">My Employees</a>
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
            <li>Use <strong>Full Rota</strong> to view all shifts and info about the shift.</li>
            <li>Use <strong>Manage Rota</strong> to create shifts.</li>
            <li>Use <strong>Manage Time Off</strong> to accept, and decline requested time off by all employees.</li>
            <li>Use <strong>New Employee</strong> to set up an account for a new employee.</li>
            <li>Use <strong>My Employees</strong> to view all current employees, and delete old ones.</li>
            <li>Use <strong>My Rota</strong> to stay up to date with upcoming shifts and view your previous shifts.</li>
            <li>Use<strong>Day Availability</strong> to show your preference so you can be scheduled when it works best.</li>
            <li>Use<strong>Time Off</strong> to quickly and easily request time off with real time status updates.</li>
        </ul>
        <p>Whether you're planning ahead or making a last-minute change, the tools you need are right here.</p>
    </div>

</div>
</body>
</html>