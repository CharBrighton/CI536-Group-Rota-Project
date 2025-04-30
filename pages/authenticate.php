<?php
session_start();
global $con;
include "../conn/conP.php";
// Check for connection errors
if (mysqli_connect_errno()) {
    // display the error
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());

}

if (!isset($_POST['username'], $_POST['password'])) {
    //form sumbmission incomplete
    exit('Please fill both the username and password fields!');
}
// Prepare our SQL to prevent SQL injection
if ($stmt = $con->prepare('SELECT id, password, employeeType FROM accounts WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    // Check if account exists
    if ($stmt->num_rows > 0) {
        // Account exists
        $stmt->bind_result($id, $password, $employeeType);
        $stmt->fetch();
        //hashing
        if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $_SESSION['account_loggedin'] = TRUE;
            $_SESSION['account_name'] = $_POST['username'];
            $_SESSION['account_id'] = $id;
            if($employeeType == 1) {
                header('Location: manager_index.php');
            }elseif ($employeeType == 0) {
                header('Location: employee_index.php');

            }else{
                echo "employee type unknown please contact your system administrator";
            }

            exit;
        } else {
            // Incorrect password
            echo 'Incorrect username and/or password!';
        }
    } else {
        // Incorrect username
        echo 'Incorrect username and/or password!';
    }
    // Close the prepared statement
    $stmt->close();
}
?>