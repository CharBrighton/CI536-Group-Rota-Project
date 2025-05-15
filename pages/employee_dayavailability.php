<?php
session_start();
if (!isset($_SESSION['account_loggedin'])) {
    header("Location: index.php");
    exit;
}
if (isset($_SESSION['manager'])) {
    header("Location: manager_index.php");
    exit;
}

include "../conn/conn.php";
global $conn;
$uid = $_SESSION['account_id']; // You can replace this with dynamic session user ID if needed

// Process form submission before any output
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Use prepared statement for safer query
    $stmt = $conn->prepare("UPDATE day_availability SET monday = ?, tuesday = ?, wednesday = ?, thursday = ?, friday = ?, saturday = ?, sunday = ? WHERE employee_id = ?");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    // Bind parameters as integers
    $stmt->bind_param(
        "iiiiiiii",
        $_POST['Monday'],
        $_POST['Tuesday'],
        $_POST['Wednesday'],
        $_POST['Thursday'],
        $_POST['Friday'],
        $_POST['Saturday'],
        $_POST['Sunday'],
        $uid
    );

    if ($stmt->execute()) {
        $stmt->close();
        // Redirect immediately after update
        header('Location: employee_dayavailability.php');
        exit;
    } else {
        echo "Error updating availability: " . htmlspecialchars($stmt->error);
        $stmt->close();
    }
}

// Fetch current availability to display checkboxes
$sql = "SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM day_availability WHERE employee_id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . htmlspecialchars($conn->error));
}
$stmt->bind_param("i", $uid);
$stmt->execute();
$stmt->bind_result($monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
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
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="employee_index.php">Logo (Employee Portal)</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="employee_rota.php">My Rota</a></li>
                    <li class="nav-item"><a class="nav-link" href="employee_timeoff.php">Time Off</a></li>
                    <li class="nav-item"><a class="nav-link" href="employee_dayavailability.php">Day Availability</a></li>
                    <li class="nav-item"><a class="nav-link" href="../logic/logout_logic.php">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <h2>Current Availability</h2>
        <?php
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $DAYS = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $values = [$monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday];

        for ($i = 0; $i < 7; $i++) {
            $checked = ($values[$i] == 1) ? 'checked' : '';
            echo "<label for='{$days[$i]}'>{$DAYS[$i]}</label>";
            echo "<input type='checkbox' name='{$days[$i]}' value='1' style='pointer-events: none;' $checked><br>";
        }
        ?>
    </div>

    <div class="container-fluid">
        <h2>New Availability</h2>
        <form method="POST">
            <?php
            for ($i = 0; $i < 7; $i++) {
                // Hidden input to submit 0 if unchecked
                echo "<label for='{$DAYS[$i]}'>{$DAYS[$i]}</label>";
                echo "<input type='hidden' name='{$DAYS[$i]}' value='0'>";
                echo "<input type='checkbox' id='{$DAYS[$i]}' name='{$DAYS[$i]}' value='1'><br>";
            }
            ?>
            <input type="submit" value="Submit" name="submit">
        </form>
    </div>
</div>
</body>
</html>
