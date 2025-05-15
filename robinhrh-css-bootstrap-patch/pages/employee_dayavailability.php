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
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <title>Day Availability</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

    <div class="container-fluid">
        <h2>Current Availability</h2>
        <?php

        $uid = 28;

        global $conn;
        include "../conn/conn.php";

        $sql = "SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM day_availability WHERE employee_id = $uid";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);

        $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
        $DAYS = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

        for ($i = 0; $i < 7; $i++) {
            if ($row[$i] == 1) {
                echo "<label for='$days[$i]'>$DAYS[$i]</label>";
                echo "<input type='checkbox' name='$days[$i]' value='$days[$i]' style='pointer-events: none;' checked><br>";
            } else {
                echo "<label for='$days[$i]'>$DAYS[$i]</label>";
                echo "<input type='checkbox' name='$days[$i]' value='$days[$i]' style='pointer-events: none;'><br>";
            }
        }


        ?>
    </div>

    <div class="container-fluid">
        <h2>New Availability</h2>
        <form method="POST">
        <label for="monday">Monday</label>
        <input type="hidden" id="Monday" name="Monday" value="0">
        <input type="checkbox" id="Monday" name="Monday" value="1">

        <label for="tuesday">Tuesday</label>
        <input type="hidden" id="Tuesday" name="Tuesday" value="0">
        <input type="checkbox" id="Tuesday" name="Tuesday" value="1">

        <label for="wednesday">Wednesday</label>
        <input type="hidden" id="Wednesday" name="Wednesday" value="0">
        <input type="checkbox" id="Wednesday" name="Wednesday" value="1">

        <label for="thursday">Thursday</label>
        <input type="hidden" id="Thursday" name="Thursday" value="0">
        <input type="checkbox" id="Thursday" name="Thursday" value="1">

        <label for="friday">Friday</label>
        <input type="hidden" id="Friday" name="Friday" value="0">
        <input type="checkbox" id="Friday" name="Friday" value="1">

        <label for="saturday">Saturday</label>
        <input type="hidden" id="Saturday" name="Saturday" value="0">
        <input type="checkbox" id="Saturday" name="Saturday" value="1">

        <label for="sunday">Sunday</label>
        <input type="hidden" id="Sunday" name="Sunday" value="0">
        <input type="checkbox" id="Sunday" name="Sunday" value="1">

        <input type="submit" value="Submit" name="submit">
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $monday = $_POST['Monday'];
        $tuesday = $_POST['Tuesday'];
        $wednesday = $_POST['Wednesday'];
        $thursday = $_POST['Thursday'];
        $friday = $_POST['Friday'];
        $saturday = $_POST['Saturday'];
        $sunday = $_POST['Sunday'];

        $sql = "UPDATE day_availability SET monday = '$monday', tuesday = '$tuesday', wednesday = '$wednesday', thursday = '$thursday', friday = '$friday', saturday = '$saturday', sunday = '$sunday' WHERE employee_id = '$uid'";
        if (mysqli_query($conn, $sql)) {
            header('Location: employee_dayavailability.php');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>
</div>
</body>
</html>