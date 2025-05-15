<?php
global $conn;
include "../logic/today_date.php";

function employee_my_future_shifts($uid): void
{
    global $conn;
    $now_date = now_date();
    $get_shifts_sql = "SELECT shift_date, start_time, end_time, break_time
                        FROM employee
                        INNER JOIN shifts
                        ON employee.employee_id = shifts.employee_id
                        WHERE employee.employee_id = $uid 
                        AND shifts.shift_date >= '$now_date'";
    $result = mysqli_query($conn, $get_shifts_sql);

    while ($row = mysqli_fetch_assoc($result)) {
        //get value associated with that row and column
        $shift_date = $row["shift_date"];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
        $break_time = $row['break_time'];

        echo "<li>Date: $shift_date Start: $start_time End: $end_time Break: $break_time</li>";

    }
    mysqli_free_result($result);
    mysqli_close($conn);

}

function employee_my_previous_shifts($uid): void
{
    global $conn;
    $now_date = now_date();
    $get_shifts_sql = "SELECT shift_date, start_time, end_time, break_time
                        FROM employee
                        INNER JOIN shifts
                        ON employee.employee_id = shifts.employee_id
                        WHERE employee.employee_id = $uid 
                        AND shifts.shift_date < '$now_date'";
    $result = mysqli_query($conn, $get_shifts_sql);

    while ($row = mysqli_fetch_assoc($result)) {
        //get value associated with that row and column
        $shift_date = $row["shift_date"];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
        $break_time = $row['break_time'];

        echo "<li>Date: $shift_date Start: $start_time End: $end_time Break: $break_time</li>";

    }
    mysqli_free_result($result);

    mysqli_close($conn);

}

function now_date(): string
{
    return today_date();
}

function name($uid): void{
    global $conn;
    $name_sql = "SELECT first_name, last_name
    FROM employee
    WHERE employee_id = $uid ";
    $result = mysqli_query($conn, $name_sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row["first_name"] . " " . $row["last_name"];
        echo "Hello, $name!";
    }
    mysqli_free_result($result);

    mysqli_close($conn);

}
mysqli_close($conn);

