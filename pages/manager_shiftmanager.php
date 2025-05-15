<?php
session_start();
if (!isset($_SESSION['account_loggedin'])) {
    header("location:index.php");
    exit;
}
if (!isset($_SESSION['manager'])) {
    header("location:employee_index.php");
}
//hides errors showing on the page but keep commented out for dev purposes
//error_reporting(0);
global $conn;
include "../conn/conn.php";
include "../logic/manager_shiftmanager_logic.php";
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <title>Manage Rota</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="../css/general_css.css" rel="stylesheet">
</head>

<body>
<div class="wrapper">
    <div class="topnav">
        <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="manager_index.php">Logo (Manager Portal)</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapsibleNavbar">
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


    <div class="container-fluid">
        <form method="post">
            <label for="date">Select Date:</label>
            <input type="date" id="date" name="date">
            <input type="submit" name="submit" value="submit">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $date = $_POST['date'];
            echo "<h1>Date Selected $date</h1>";
            echo "<h2>Current Shifts</h2>";
            echo "<ul>";
            return_current_shifts($date);
            echo "</ul>";

            echo "<h2>Add Person To Date $date</h2>";
            add_person_to_date($date);
        }
        ?>
    </div>

</div>
</body>
</html>