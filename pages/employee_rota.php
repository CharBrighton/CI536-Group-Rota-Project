<?php
//hides errors showing on the page but keep commented out for dev purposes
//error_reporting(0);
global $conn;
include "../conn/conn.php";
include "../logic/employee_rota_logic.php";

session_start();
if (!isset($_SESSION['account_loggedin'])) {
    header("location:index.php");
    exit;
}
if (isset($_SESSION['manager'])) {
    header("location:manager_index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Rota</title>
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
        <h1>My Shifts</h1>
        <p>Welcome to the My Shifts page where below you can view your upcoming shifts and previous shifts.</p>
    </div>

    <div class="container-fluid">
        <h3><?= htmlspecialchars($_SESSION['account_name'], ENT_QUOTES) ?>'s Upcoming Shifts</h3>
        <div>
            <ul>
                <?php employee_my_future_shifts($_SESSION['account_id']); ?>
            </ul>
        </div>
        <div>
            <h3><?= htmlspecialchars($_SESSION['account_name'], ENT_QUOTES) ?>'s Previous Shifts</h3>
            <ul>
                <?php employee_my_previous_shifts($_SESSION['account_id']); ?>
            </ul>
        </div>
    </div>
</div>
</body>
</html>