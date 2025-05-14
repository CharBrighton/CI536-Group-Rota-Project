<?php
session_start();
if (!isset($_SESSION['account_loggedin'])) {
    header("location:index.php");
    exit;
}
if (!isset($_SESSION['manager'])) {
    header("location:employee_index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="../css/general_css.css" rel="stylesheet">
    <title>Register</title>
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
        <h2>My Employees</h2>
        <?php
        global $conn;
        include "../conn/conn.php";

        $sql = "SELECT first_name, last_name, dob, pay_rate, manager FROM employee";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);

        while ($row = mysqli_fetch_assoc($result)) {
            $manager = "";
            if ($row["manager"] == 1) {
                $manager = "Yes";
            } else {
                $manager = "No";
            }

            echo "<ul>";
            echo "<li>Name: " . $row["first_name"] . " " . $row["last_name"] . "</li>";
            echo "<li>Dob: " . $row["dob"] . "</li>";
            echo "<li>Pay Rate: " . $row["pay_rate"] . "</li>";
            echo "<li>Manager: " . $manager . "</li>";
            echo "</ul>";
        }
        ?>
    </div>

    <div class="container-fluid">

        <h2>Delete Employee</h2>

        <form method="POST">

            <?php
            include "../logic/manager_my_employees_logic.php";

            ?>
            <select name='employee_id' id='person'>
                <?php
                all_select();
                ?>
            </select>

            <input type="submit" name="submit" value="submit">

        </form>

        <?php
        global $conn;
        include "../conn/conn.php";

        if (isset($_POST['submit'])) {
            $uid = $_POST['employee_id'];
            $_SESSION['employee_id'] = $uid;
            $sql = "DELETE FROM day_availability WHERE employee_id = '$uid'";
            if (mysqli_query($conn, $sql)) {
                $sql2 = "DELETE FROM employee WHERE employee_id = '$uid'";
                if (mysqli_query($conn, $sql2)) {
                    echo '<script>alert("Record deleted successfully")</script>';
                } else {
                    echo "Error deleting record: " . mysqli_error($conn);
                }
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }

            mysqli_close($conn);


        }
        ?>
    </div>
</div>
</body>
</html>