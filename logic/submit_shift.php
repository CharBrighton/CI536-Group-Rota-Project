<?php

echo '<script>alert("Welcome to Geeks for Geeks")</script>';

$uid = $_POST['employee_id'];
echo $uid;
$starttime = $_POST['starttime'] . ":00";
echo $starttime;
$endtime = $_POST['endtime'] . ":00";
echo $endtime;
$breaktime = $_POST['breaktime'] . ":00";
echo $breaktime;
$role = $_POST['role'];
echo $role;

echo "$uid, $starttime, $endtime, $breaktime, $role";


//$sql = "INSERT INTO shifts (employee_id, start_time, end_time, break_time, shift_date, position
//VALUES ('$uid','$starttime','$endtime','$breaktime','$date','$role')";

//mysqli_query($conn, $sql);

