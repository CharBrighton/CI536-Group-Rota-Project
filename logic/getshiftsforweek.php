<?php
include "../conn/conn.php";
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["start_date"]) && isset($_POST["end_date"])) {
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    $stmt = $conn->prepare("
        SELECT shift_date, first_name, last_name, start_time, end_time, break_time
        FROM employee
        INNER JOIN shifts ON employee.employee_id = shifts.employee_id
        WHERE shift_date BETWEEN ? AND ?
        ORDER BY shift_date, start_time
    ");
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    $shiftsByDate = [];

    while ($row = $result->fetch_assoc()) {
        $date = $row['shift_date'];
        if (!isset($shiftsByDate[$date])) {
            $shiftsByDate[$date] = [];
        }
        $shiftsByDate[$date][] = [
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'start_time' => $row['start_time'],
            'end_time' => $row['end_time'],
            'break_time' => $row['break_time'],
        ];
    }

    echo json_encode($shiftsByDate);

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>
