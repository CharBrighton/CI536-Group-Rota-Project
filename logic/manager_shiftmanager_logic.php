<?php
function return_current_shifts($date): void
{
global $conn;
    $get_shifts_sql = "SELECT first_name , last_name, shift_date, start_time, end_time, break_time
                        FROM employee
                        INNER JOIN shifts
                        ON employee.employee_id = shifts.employee_id
                        WHERE shift_date = '$date' ";
    $result = mysqli_query($conn, $get_shifts_sql);

while ($row = mysqli_fetch_assoc($result)) {
//get value associated with that row and column
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$shift_date = $row["shift_date"];
$start_time = $row['start_time'];
$end_time = $row['end_time'];
$break_time = $row['break_time'];

echo "<li>Name: $first_name $last_name Date: $shift_date Start: $start_time End: $end_time Break: $break_time</li>";

}
}

function add_person_to_date(): void
{
    echo "ADD FORM AND SQL ETC HERE";
}
?>