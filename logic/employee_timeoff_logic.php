<?php
include "../logic/today_date.php";
include "../conn/conn.php";

global $conn;
$url = $_SERVER['HTTP_REFERER'];

if ($_POST['submit'] == "Request") {
    if (strlen($_POST['requestedDate']) == 10) {

        $id = $_POST['userID'];
        $requestDate = $_POST['requestedDate'];
        $dateOfRequest = $_POST['currentDate'];

        $exist_sql = "SELECT * FROM timeoff_requests ";
        $exist_result = $conn->query($exist_sql);

        if ($exist_result->num_rows > 0) {
            $exist_flag = false;
            while($row = $exist_result->fetch_assoc()) {
                if ($row["employee_id"] == $id && $row["shift_date"] == $requestDate) {
                    $exist_flag = true;
                    if ($row["request_status"] == -2) {
                        $update_sql = "UPDATE `timeoff_requests` SET `request_status` = 0 
                                WHERE `shift_date` = '" . $requestDate . "' AND `employee_id` = " . $id;

                        if ($conn->query($update_sql) === TRUE) {
                            echo "Date Requested.<br>";
                        } else {
                            echo "Error: " . $update_sql . "<br>" . $conn->error;
                        }
                    }
                    else {
                        echo "Request Already Exists.";
                    }
                }

            }

            if (!$exist_flag) {
                $sql = "INSERT INTO timeoff_requests (employee_id, shift_date, request_date, request_status)
                        VALUES ('$id', '$requestDate', '$dateOfRequest', '0')";

                if ($conn->query($sql) === TRUE) {
                    echo "Date Requested.<br>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            echo "<br><a href='" . $url . "'>Return</a>";
        } else {

            echo $requestDate;
            echo "<a href='" . $url . "'>Return</a>";


        }

    } else {
        echo "Error: No date selected. <br>";
        echo "<a href='" . $url . "'>Return</a>";
    }

} elseif ($_POST['submit'] == "Cancel") {
    if (isset($_POST['cancel-checkbox'])) {
        $id = $_POST['userID'];
        $date = $_POST['cancel-checkbox'];

        $sql = "        UPDATE `timeoff_requests` SET `request_status` = -2 
                        WHERE `shift_date` = '" . $date . "' AND `employee_id` = " . $id;

        if ($conn->query($sql) === TRUE) {
            echo "Request Cancelled.<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    } else {
        echo "No Shift Selected to cancel. <br>";
    }
    echo "<a href='" . $url . "'>Return</a>";
} else {
    echo "Invalid Request <br>";
    echo "<a href='" . $url . "'>Return</a>";
}
