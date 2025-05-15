<?php

function all_select(): void
{

    global $conn;
    include "../conn/conn.php";

    $get_shifts_sql = "SELECT employee.employee_id, first_name , last_name
                        FROM employee";
    $result = mysqli_query($conn, $get_shifts_sql);

    while ($row = mysqli_fetch_assoc($result)) {
//get value associated with that row and column
        $employee_id = $row['employee_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];

        echo "<option value='$employee_id'>$first_name $last_name</option>";

    }
}
