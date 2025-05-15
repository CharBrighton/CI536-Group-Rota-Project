<?php
include "../conn/conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["date"])) {
    $date = $_POST["date"];
    display_shifts_for_date($date);
}

function display_shifts_for_date($date): void
{
    global $conn;

    $stmt = $conn->prepare("
        SELECT first_name, last_name, start_time, end_time, break_time
        FROM employee
        INNER JOIN shifts ON employee.employee_id = shifts.employee_id
        WHERE shift_date = ?
    ");
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>{$row['first_name']} {$row['last_name']} Start: {$row['start_time']} End: {$row['end_time']} Break: {$row['break_time']}</p>";
        }
    } else {
        echo "<p>No Shifts For This Date</p>";
    }

    $stmt->close();
}
?>
