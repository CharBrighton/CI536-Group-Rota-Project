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
if (!isset($_SESSION['manager'])) {
    header("location:employee_index.php");
}

class Manager
{

    private int $id;

    public function __construct()
    {
        $this->setId($_SESSION['account_id']);
    }

    public function setId($id): void
    {
        $this->id = $id;
    }


    private function statusValues($status): array
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

    public function getPendingRequests(): string
    {
        global $conn;

        $result = mysqli_query($conn, "SELECT * FROM `timeoff_requests` WHERE 'request_status' = 0");
        $output = "";

        while ($row = mysqli_fetch_assoc($result)) {
            if (strtotime($row['shift_date']) > time() && $row['request_status'] == 0) {

                    $current_user_class = "";
                    if ($row['employee_id'] == $_SESSION['account_id']) {
                        $current_user_class = "current-user";
                    }

                    $requested_date = $row['shift_date'];

                    $output .= '<div class="request-div pending-row '. $current_user_class .'" >';
                    $output .= '<input value="' . $requested_date . '" name="approve-checkbox" type="radio" form="pending-form">';
            $output .= "<p> " . $row['employee_id'] . " </p>";
                    $output .= "<p> " . $requested_date . " </p>";
                    $output .= "<p> " . $row['request_date'] . " </p>";
                    $output .= '</div>';
            }
        }

        return $output;
    }

    public function populateRequests($current): string
    {
        global $conn;

        $result = mysqli_query($conn, "SELECT * FROM `timeoff_requests`");
        $output = "";

        while ($row = mysqli_fetch_assoc($result)) {
            $status = $row['request_status'];
            $requested_date = $row['shift_date'];
            $statusValues = $this->statusValues($status);

            if ($this->id == $row["employee_id"] && $status != -2) {

                if (($current && (date("Y-m-d") < $requested_date)) ||
                    (!$current) && (date("Y-m-d") >= $requested_date)) {
                    $output .= '<div class="request-div ' . $statusValues[0] . '">';
                    if ($current) {
                        $output .= '<input value="' . $requested_date . '" name="cancel-checkbox" type="radio" form="current-form">';
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

$manager = new Manager();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Time Off</title>
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
    <div class="topnav">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
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

        <div id="content">
            <div class="container" id="current-requests">
                <p>Current Requests</p>
                <div class="scroll-area" id="current-scroll">
                    <div class="request-div">
                        <p></p>
                        <p> Requested Date </p>
                        <p> Date of Request </p>
                        <p> Request Status </p>
                    </div>
                    <?php echo $manager->populateRequests(true); ?>
                </div>

                <div class="submit_row">
                    <form action="../logic/timeoff_logic.php" method="post" id="current-form">
                        <label> Date requested:
                            <input type="date" id="inpAddRequest" name="requestedDate">
                        </label>
                        <input type="submit" name="submit" value="Request">
                        <input type="submit" name="submit" value="Cancel">
                    </form>
                </div>
            </div>

            <div class="row-break"></div>

            <div class="container" id="previous-requests">
                <p>Previous Requests</p>
                <div class="scroll-area" id="previous-scroll">
                    <div class="request-div">
                        <p> Requested Date </p>
                        <p> Date of Request </p>
                        <p> Request Status </p>
                    </div>
                    <?php echo $manager->populateRequests(false); ?>
                </div>

            </div>
            <div class="row-break"></div>



            <div class="container" id="pending-requests">
                <p> Pending Requests </p>
                <div class="scroll-area" id="pending-scroll">
                    <div class="request-div">
                        <p></p>
                        <p> Employee ID </p>
                        <p> Requested Date </p>
                        <p> Date Of Request </p>
                    </div>
                    <?php echo $manager->getPendingRequests(); ?>
                </div>

                <div class="submit_row">
                    <form action="../logic/timeoff_logic.php" method="post" id="pending-form">
                        <input type="submit" name="submit" value="Accept">
                        <input type="submit" name="submit" value="Decline">
                    </form>
                </div>
            </div>

        </div>


    </div>

</div>
</body>
</html>