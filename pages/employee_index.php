<?php
//hides errors showing on the page but keep commented out for dev purposes
//error_reporting(0);
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
</head>

<body>
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
            </ul>
        </div>
    </div>
</nav>

<div>
    <h1>Welcome, EMPLOYEE NAME!</h1>
    <div>
        <p>In this employee portal you can access everything you need to view your shifts, request time off and keep on top of all your work needs.</p>
    </div>
    <div>
        <h2>Features</h2>
        <dl>
            <dt>My Rota</dt>
            <dd>View your current and previous shifts</dd>
            <dt>Time Off</dt>
            <dd>Request time off and view the progress of your requests.</dd>
            <dt>Day Availability</dt>
            <dd>Select which days of the week you would like to work.</dd>
        </dl>
    </div>
</div>

</body>
</html>