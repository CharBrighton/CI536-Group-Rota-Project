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

class Employee // PHP class for handling page
{

    private int $id;

    public function __construct() // Class constructor: sets user ID
    {
        $this->setId($_SESSION['account_id']);
    }

    public function setId($id): void  // ID setter, prevents dealing with globals
    {
        $this->id = $id;
    }


    private function statusValues($status): array  // returning values in array based on status result
    {
        switch ($status) {
            case 0:
                return ["pending-row", "Pending"];
            case 1:
                return ["accepted-row", "Accepted"];
            case -1:
                return ["declined-row", "Declined"];
            default:
                return ["Unexpected Value: " . $status, "Unexpected Value: " . $status];
        }
    }


    public function populateRequests($current): string  // Populating current and previous requests based on variable
    {
        global $conn;

        // Gets all requests
        $result = mysqli_query($conn, "SELECT * FROM `timeoff_requests`");
        $output = "";

        while ($row = mysqli_fetch_assoc($result)) {  // Iterating through requests
            $status = $row['request_status'];
            $requested_date = $row['shift_date'];
            $statusValues = $this->statusValues($status);  // Getting status class and text values from status code

            if ($this->id == $row["employee_id"] && $status != -2) {  // If current user & not cancelled

                if (($current && (date("Y-m-d") < $requested_date)) ||  // Current: after today
                    (!$current) && (date("Y-m-d") >= $requested_date)) {  // Previous: today and before
                    $output .= '<div class="request-div ' . $statusValues[0] . '">';

                    // only adds checkboxes to current request rows
                    if ($current) {
                        $output .= '<input value="' . $requested_date . '" name="cancel-checkbox" type="radio" form="requestForm">';
                    }
                    $output .= "<p> " . $requested_date . " </p>";
                    $output .= "<p> " . $row['request_date'] . " </p>";
                    $output .= "<p> " . $statusValues[1] . " </p>";
                    $output .= '</div>';
                }
            }
        }

        return $output;
    }
}

$employee = new Employee();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <title>Time Off</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/timeoff.js"></script>
    <link href="../css/general_css.css" rel="stylesheet">
    <link href="../css/timeoff.css" rel="stylesheet">
</head>

<body>
<div class="wrapper">

    <!-- Navbar -->
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
        <!-- Current Requests -->
        <div class="container" id="current-requests">
            <p>Current Requests</p>
            <div class="scroll-area" id="current-scroll">
                <div class="request-div">
                    <p></p>
                    <p> Requested Date </p>
                    <p> Date of Request </p>
                    <p> Request Status </p>
                </div>
                <?php echo $employee->populateRequests(true); ?>
            </div>

            <!-- Current Requests Buttons -->
            <div class="submit_row">
                <form action="../logic/timeoff_logic.php" method="post" id="requestForm">
                    <label> Date requested:
                        <input type="date" id="inpAddRequest" name="requestedDate">
                    </label>
                    <input type="submit" name="submit" value="Request">
                    <input type="submit" name="submit" value="Cancel">
                </form>
            </div>
        </div>

        <div class="row-break"></div>

        <!-- Previous Requests -->
        <div class="container" id="previous-requests">
            <p>Previous Requests</p>
            <div class="scroll-area" id="previous-scroll">
                <div class="request-div">
                    <p> Requested Date </p>
                    <p> Date of Request </p>
                    <p> Request Status </p>
                </div>
                <?php echo $employee->populateRequests(false); ?>
            </div>

        </div>
        <div class="row-break"></div>
    </div>


</div>
</body>
</html>