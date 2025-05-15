<?php
global $conn;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = mysqli_query($conn, "SELECT * FROM `timeoff_requests`");

$output = [];
while($row = mysqli_fetch_assoc($result)){
    $output[] = $row;
}
echo json_encode($output);
