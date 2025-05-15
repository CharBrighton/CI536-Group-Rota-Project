<?php
include "../logic/today_date.php";
include "../conn/conn.php";


global $conn;
$url = $_SERVER['HTTP_REFERER'];
session_start();
$id = $_SESSION['account_id'];

function approve($bool, $conn, $url): string // Approving/Denying Requests, $bool=true -> Accept; $bool=false -> Deny
{
    $output = "";

    if (!isset($_POST['approve-checkbox'])) {  // Invalid Request: No shift checkbox selected
        $output .= "No Request Selected <br>";
        $output .= "<a href='" . $url . "'>Return</a>";
        return $output;
    }

    if ($bool) {  // $Setting variables based on request type
        $status = 1;
        $output_msg = "Accepted";
    } else {
        $status = -1;
        $output_msg = "Declined";
    }

    // Splitting checkbox values: checkbox contains two values as a csv
    // $checkbox_values[0] = Requested Date
    // $checkbox_values[1] = Employee ID
    $checkbox_values = explode(",", $_POST['approve-checkbox']);

    // SQL to update record in table with new status value
    $sql = "UPDATE `timeoff_requests` SET `request_status` = '" . $status . "' 
                                WHERE `shift_date` = '" . $checkbox_values[0] . "' AND `employee_id` = " . $checkbox_values[1];

    if ($conn->query($sql) === TRUE) {  // Checks query is successfully executed and informs user of status
        $output .= "Request ". $output_msg .".<br>";
    } else {
        $output .= "Error: " . $sql . "<br>" . $conn->error;
    }

    $output .= "<a href='" . $url . "'>Return</a>";
    return $output;
}

// Submitting Request
if ($_POST['submit'] == "Request") {
    if (strlen($_POST['requestedDate']) == 10) {  // Validates date has been selected, as all dates have 10 chars (e.g. 01-01-1900 )


        $requestDate = $_POST['requestedDate'];
        $dateOfRequest = today_date();

        $exist_sql = "SELECT * FROM timeoff_requests ";
        $exist_result = $conn->query($exist_sql);

        if ($exist_result->num_rows > 0) {  // Checks query executes successfully
            $exist_flag = false;
            while($row = $exist_result->fetch_assoc()) {  // Iterating query results
                if ($row["employee_id"] == $id && $row["shift_date"] == $requestDate) {
                    $exist_flag = true;  // Existing request found
                    if ($row["request_status"] == -2) {  // If existing request is cancelled, it can be requested again
                        $update_sql = "UPDATE `timeoff_requests` SET `request_status` = 0 
                                WHERE `shift_date` = '" . $requestDate . "' AND `employee_id` = " . $id;

                        if ($conn->query($update_sql) === TRUE) {
                            echo "Date Requested.<br>";
                        } else {
                            echo "Error: " . $update_sql . "<br>" . $conn->error;
                        }
                    }
                    else {  // If request exists and not cancelled, no query is executed and error is returned
                        echo "Request Already Exists.";
                    }
                }

            }

            if (!$exist_flag) { // No existing request, creates request
                $sql = "INSERT INTO timeoff_requests (employee_id, shift_date, request_date, request_status)
                        VALUES ('$id', '$requestDate', '$dateOfRequest', '0')";

                if ($conn->query($sql) === TRUE) {
                    echo "Date Requested.<br>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            echo "<br><a href='" . $url . "'>Return</a>";
        } else {  // No output from SQL, as table should never be empty, this means there must be a server error
            echo "Server Error";
            echo "<a href='" . $url . "'>Return</a>";


        }

    } else {  // No Request Checkbox selected error
        echo "Error: No date selected. <br>";
        echo "<a href='" . $url . "'>Return</a>";
    }

} elseif ($_POST['submit'] == "Cancel") {  // Cancelling existing request
    if (isset($_POST['cancel-checkbox'])) {  // Check request has been selected
        $date = $_POST['cancel-checkbox'];
        // Updating record, setting status to cancelled, as records cannot be removed
        $sql = "        UPDATE `timeoff_requests` SET `request_status` = -2 
                        WHERE `shift_date` = '" . $date . "' AND `employee_id` = " . $id;

        if ($conn->query($sql) === TRUE) {  // Checks query executed correctly
            echo "Request Cancelled.<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    } else {  // No request checkbox selected
        echo "No Shift Selected to cancel. <br>";
    }
    echo "<a href='" . $url . "'>Return</a>";
}
elseif ($_POST['submit'] == "Accept") {  // Accepting pending request
    echo approve(true, $conn, $url);
}

elseif ($_POST['submit'] == "Decline") {  // Declining pending request
    echo approve(false, $conn, $url);
}

else {  // No submit type matched: user accessed the file without posting a form
    echo "Invalid Request <br>";
    echo "<a href='" . $url . "'>Return</a>";
}

mysqli_close($conn);

