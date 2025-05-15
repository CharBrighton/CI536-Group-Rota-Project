<?php
global $conn;
include "../conn/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["date"])) {
    $receivedVariable = $_POST["date"];
    // Process the received variable here
    $return = shifts($receivedVariable);
    echo $return;
}

function shifts($date): void
{
    //show saved names
    global $conn;
    $get_shifts_sql = "SELECT first_name , last_name, start_time, end_time, break_time
                        FROM employee
                        INNER JOIN shifts
                        ON employee.employee_id = shifts.employee_id
                        WHERE shift_date = '$date' ";
    $result = mysqli_query($conn, $get_shifts_sql);

    while ($row = mysqli_fetch_assoc($result)) {
        //get value associated with that row and column
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
        $break_time = $row['break_time'];

        echo "<p>$first_name $last_name Start: $start_time End: $end_time Break: $break_time</p>";

    }
}
?>