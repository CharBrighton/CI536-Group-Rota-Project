<?php
function return_current_shifts($date): void
{
    global $conn;
    $sql = "SELECT first_name, last_name, shift_date, start_time, end_time, break_time
            FROM employee
            INNER JOIN shifts ON employee.employee_id = shifts.employee_id
            WHERE shift_date = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $first_name = htmlspecialchars($row['first_name']);
        $last_name = htmlspecialchars($row['last_name']);
        $shift_date = $row["shift_date"];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
        $break_time = $row['break_time'];

        echo "<li>Name: $first_name $last_name Date: $shift_date Start: $start_time End: $end_time Break: $break_time</li>";
    }
    $stmt->close();
}

function add_person_to_date($date): void
{
    echo "
    <form method='POST'>
        <label for='person'>Select Person:</label>
        <select name='employee_id' id='person' required>
        <option disabled selected value>Select Employee:</option>
            ";
    people_available($date);
    echo "
        </select>
        <label for='starttime'>Start Time:</label>
        <input type='time' name='starttime' value='' required>
        <label for='endtime'>End Time:</label>
        <input type='time' name='endtime' value='' required>
        <label for='breaktime'>Break Time:</label>
        <input type='time' name='breaktime' value='' required>
        <label for='role'>Role:</label>
        <select name='role'>
            <option value='0'>Regular</option>
            <option value='1'>Shift Manager</option>
        </select>
        <label for='date'>Shift Date:</label>
        <input type='text' value='$date' name='date' readonly>
        <input type='submit' name='submit2' value='Submit'>
    </form>
    ";
}

function people_available($date): void
{
    global $conn;
    $timestamp = strtotime($date);
    $wday = date('w', $timestamp); // 0=Sun, 6=Sat
    $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

    $day_column = $days[$wday];
    $sql = "SELECT employee.employee_id, first_name, last_name
            FROM employee
            INNER JOIN day_availability ON employee.employee_id = day_availability.employee_id
            WHERE $day_column = 1";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $employee_id = htmlspecialchars($row['employee_id']);
        $first_name = htmlspecialchars($row['first_name']);
        $last_name = htmlspecialchars($row['last_name']);
        echo "<option value='$employee_id'>$first_name $last_name</option>";
    }
}

// Process form submission before output
if (isset($_POST['submit2'])) {
    global $conn;

    $date = $_POST['date'];
    $uid = $_POST['employee_id'];
    $starttime = $_POST['starttime'] . ":00";
    $endtime = $_POST['endtime'] . ":00";
    $breaktime = $_POST['breaktime'] . ":00";
    $role = $_POST['role'];

    $sql = "INSERT INTO shifts (employee_id, start_time, end_time, break_time, shift_date, position)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssi", $uid, $starttime, $endtime, $breaktime, $date, $role);

    try {
        if ($stmt->execute()) {
            echo '<script>alert("Shift successfully added!")</script>';
        } else {
            echo "Error: " . htmlspecialchars($stmt->error);
        }
        $stmt->close();
    } Catch (Exception $e) {
        echo '<script>alert("Error: Employee already scheduled for date")</script>';
    }
}
?>
