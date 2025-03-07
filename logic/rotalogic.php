<?php
global $conn;
include "../conn/conn.php";

function dayavailable($day){
    //show saved names
    global $conn;
    $get_names_sql = "SELECT first_name , last_name 
                    FROM employee 
                    INNER JOIN day_availability 
                    ON employee.employee_id = day_availability.employee_id 
                    WHERE day_availability.$day = True";
    $result = mysqli_query($conn, $get_names_sql);

    while ($row = mysqli_fetch_assoc($result)) {
        //get value associated with that row and column
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        echo "<p>$first_name $last_name</p>";
    }
}
?>