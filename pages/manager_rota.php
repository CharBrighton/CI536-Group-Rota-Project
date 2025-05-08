<?php
session_start();
if (!isset($_SESSION['account_loggedin'])) {
    header("location:index.php");
    exit;
}
if(!isset($_SESSION['manager'])){
    header("location:employee_index.php");
}
//hides errors showing on the page but keep commented out for dev purposes
//error_reporting(0);
global $conn;
include "../conn/conn.php";
include '../logic/getshiftsforday.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Full Rota</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/general_css.css" rel="stylesheet">
    <link href="../css/rota.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/manager_rota.js"></script>
    <script src="../js/manager_rota2.js"></script>
    <script src="../js/moment.js"></script>
</head>

<body>
<div class="wrapper">
    <div class="topnav">
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
    </div>

    <div class="main">
        <div class="buttons">
        <button id="prev">&#8249;</button>
        <button id="today">Today</button>
        <button id="next">&#8250;</button>
        </div>

        <div id="month"></div>
    </div>

    <div class="monday" id="monday">
        <p id="1">Monday</p>
        <p id="Mon_date"></p>
        <h3>Monday Shifts</h3>
        <div id="mon_results">
        </div>
    </div>
    <div class="tuesday" id="tuesday">
        <p id="2">Tuesday</p>
        <p id="Tue_date"></p>
        <h3>Tuesday Shifts</h3>
        <div id="tue_results">

        </div>
    </div>
    <div class="wednesday" id="wednesday">
        <p id="3">Wednesday</p>
        <p id="Wed_date"></p>
        <h3>Wednesday Shifts</h3>
        <div id="wed_results">

        </div>
    </div>
    <div class="thursday" id="thursday">
        <p id="4">Thursday</p>
        <p id="Thu_date"></p>
        <h3>Thursday Shifts</h3>
        <div id="thu_results">

        </div>
    </div>
    <div class="friday" id="friday">
        <p id="5">Friday</p>
        <p id="Fri_date"></p>
        <h3>Friday Shifts</h3>
        <div id="fri_results">

        </div>
    </div>
    <div class="saturday" id="saturday">
        <p id="6">Saturday</p>
        <p id="Sat_date"></p>
        <h3>Saturday Shifts</h3>
        <div id="sat_results">

        </div>
    </div>
    <div class="sunday" id="sunday">
        <p id="7">Sunday</p>
        <p id="Sun_date"></p>
        <h3>Sunday Shifts</h3>
        <div id="sun_results">

        </div>
    </div>


</div>
</body>
</html>