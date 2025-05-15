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

function add_person_to_date($date): void
{
    global $date;
    echo "
    <form method='POST'>
    <label for='person'>Select Person:</label>
    <select name='employee_id' id='person'>
        ";
    people_available($date);
    echo "
    </select>
    <label for='starttime'>Start Time:</label>
    <input type='time' name='starttime' value='starttime'>
    <label for='endtime'>End Time:</label>
    <input type='time' name='endtime' value='endtime'>
    <label for='Break Time'>Break Time:</label>
    <input type='time' name='breaktime' value='breaktime'>
    <label for='role'>Role:</label>
    <Select name='role'>
    <option value='0'>Regular</option>
    <option value='1'>Shift Manager</option>
    </Select>
    <label for='date'>Shift Date:</label>
    <input type='text' value='$date' name='date' readonly>
    <input type='submit' name='submit2' value='submit'>
    </form>

    ";
}

if (isset($_POST['submit2'])) {
    global $conn;

    $date = $_POST['date'];
    $uid = $_POST['employee_id'];
    $starttime = $_POST['starttime'] . ":00";
    $endtime = $_POST['endtime'] . ":00";
    $breaktime = $_POST['breaktime'] . ":00";
    $role = $_POST['role'];

    $sql = "INSERT INTO shifts (employee_id, start_time, end_time, break_time, shift_date, position)
    VALUES ('$uid','$starttime','$endtime','$breaktime','$date','$role')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("SUCCESS")</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}

function people_available($date): void
{

    $timestamp = strtotime($date);
    $mydate=getdate($timestamp);
    $capday = $mydate['wday'];
    $days = array('sunday','monday','tuesday','wednesday','thursday','friday','saturday');

    global $conn;
    $get_shifts_sql = "SELECT employee.employee_id, first_name , last_name
                        FROM employee
                        INNER JOIN day_availability
                        ON employee.employee_id = day_availability.employee_id
                        WHERE $days[$capday] = 1 ";
    $result = mysqli_query($conn, $get_shifts_sql);

    while ($row = mysqli_fetch_assoc($result)) {
//get value associated with that row and column
        $employee_id = $row['employee_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];

        echo "<option value='$employee_id'>$first_name $last_name</option>";

    }
}

?>