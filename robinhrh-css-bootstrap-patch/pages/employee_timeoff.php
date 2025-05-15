<?php
//hides errors showing on the page but keep commented out for dev purposes
//error_reporting(0);
global $conn;
include "../conn/conn.php";

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
<html lang="en" data-bs-theme="dark">
<head>
    <title>Time Off</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/employee_timeoff.js"></script>
    <link href="../css/general_css.css" rel="stylesheet">
</head>

<body>
<div class="wrapper">

    <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
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
    <div id="content">
        <div class="container" id="current-requests">
            <p>Current Requests</p>
            <div class="scroll-area" id="current-scroll">
            </div>

            <div class="submit_row">
                <form action="../logic/employee_timeoff_logic.php" method="post" id="requestForm">
                    <label> Date requested:
                        <input type="date" id="inpAddRequest" name="requestedDate">
                    </label>
                    <input type="submit" name="submit" value="Request">
                    <input type="submit" name="submit" value="Cancel">
                </form>
            </div>
        </div>

        <br><br>

        <div class="container" id="previous-requests">
            <p>Previous Requests</p>
            <div class="scroll-area" id="previous-scroll">
            </div>
        </div>
    </div>


</div>
</body>
</html>