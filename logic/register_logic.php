<?php

function displayError($msg)
{
    echo  $msg;
    exit("<br></b><a href='../pages/manager_register_employee.php'>Return</a>");
}

if (mysqli_connect_errno()) {
    displayError('Failed to connect to MySQL: ' . mysqli_connect_error());

}

if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    //FAILED
    displayError('Please complete the registration form!');
}
//check if empty
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
    //is empty
    displayError('Please complete the registration form');
}
// Validate email address
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	displayError('Email is not valid!');
}
// Validate password (between 5 and 20 characters long)
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	displayError('Password must be between 5 and 20 characters long!');
}
// Validate username (must be alphanumeric)
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
	displayError('Username is not valid!<br>Use only letters and numbers!');
} elseif (strlen(trim($_POST['username'])) < 3  || strlen(trim($_POST['username'])) > 32) {
    displayError('Username must be between 3 and 32 characters long (spaces at the start and end are removed)!');
}

// Validate pay rate is numeric
try {
    $int = (int) $_POST['payrate'];
    if ($int != $_POST['payrate']) {
        displayError('Decimal value is not valid! Pay Rate must be in pence!');
    }
} catch (Exception $e) {
    displayError('Pay rate must be an integer.<br>Please enter your pay rate in pence.');
}

// Validate date of birth
try {
    $user_date = new DateTime($_POST['date']);
    $upper = new DateTime("-120 years");
    $lower = new DateTime("-16 years");

    if ($user_date > $lower) {
        displayError("Employee must be at least 16 years old.");
    } elseif ($user_date < $upper) {
        displayError('Employee must be under 120 years old.<br>
If you are above 120 and would like to make a complaint, contact an administrator.');
    }

} catch (DateMalformedStringException $e) {
    displayError('Date is not valid!<br>Please enter a valid date.');
}

if (isset($_POST['date'])) {
    displayError("Successful date");
}

$checked = isset($_POST['employeeType']) ? 1 : 0;

pswrd($checked);

// Check username is new'
function pswrd($checked): void
{
    global $con;
    include "../conn/conP.php";

    if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        //store result
        $stmt->store_result();
        // Check if the account exists
        if ($stmt->num_rows > 0) {
            // Username already exists
            echo 'Username already exists! Please choose another!';
        } else {

            $registered = date('Y-m-d H:i:s');
            //hashing
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            // Username added
            if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, registered, employeeType) VALUES (?, ?, ?, ?, ?)')) {
                // Bind POST data
                $stmt->bind_param('ssssi', $_POST['username'], $password, $_POST['email'], $registered, $checked);
                $stmt->execute();

                $username_variable = $_POST['username'];
                if ($stmt = $con->prepare("SELECT id FROM accounts WHERE username = ?")) {
                    // Bind the username to the placeholder (?)
                    $stmt->bind_param("s", $username_variable); // "s" means string type
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        // Bind the result (i.e., the ID column)
                        $stmt->bind_result($jamesid);
                        $stmt->fetch(); // Fetch the result into $jamesid

                        employeeAdd($checked, $jamesid);
                    }
                }

            } else {
                // Sql error
                echo 'Could not prepare statement!';
            }

        }
        // Close
        $stmt->close();
    }
    $con->close();
}

function employeeAdd($checked, $jamesid): void
{
    global $conn;
    include "../conn/conn.php";

    $fn = $_POST['firstname'];
    $ln = $_POST['lastname'];
    $dob = $_POST['date'];
    $payrate = $_POST['payrate'];

    $stmt = "INSERT INTO employee (employee_id, first_name, last_name, dob, pay_rate, manager) VALUES ('$jamesid','$fn', '$ln', '$dob', '$payrate', '$checked')";
    if(mysqli_query($conn, $stmt)){
        employeeGetId($conn, $checked);
    }
    else{
        echo "Error: " . $stmt . "<br>" . mysqli_error($conn);
    }

}

function employeeGetId($conn, $checked): void
{

    $fn = $_POST['firstname'];
    $ln = $_POST['lastname'];
    $dob = $_POST['date'];
    $payrate = $_POST['payrate'];

    $stmt = "SELECT employee_id FROM employee WHERE first_name = '$fn' AND last_name = '$ln' AND pay_rate = '$payrate' AND dob = '$dob'";
    $result = mysqli_query($conn, $stmt);
    $row = mysqli_fetch_row($result);
    $coobasId = $row[0];

    insertDays($conn,$coobasId);

}
function insertDays($conn,$coobasId): void
{
    $stmt = "INSERT INTO day_availability (employee_id, monday, tuesday, wednesday, thursday, friday, saturday, sunday) VALUES ('$coobasId', '0', '0', '0', '0','0','0','0')";
    if(mysqli_query($conn, $stmt)){
        header('Location: ../pages/manager_index.php');
    }
    else{
        echo "Error: " . $stmt . "<br>" . mysqli_error($conn);
    }
}
// Close 
?>