<?php
//setup on local servee first change 
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    //FAILED
    exit('Please complete the registration form!');
}
//check if empty
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
    //is empty
    exit('Please complete the registration form');
}
// Validate email address
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Email is not valid!');
}
// Validate password (between 5 and 20 characters long)
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	exit('Password must be between 5 and 20 characters long!');
}
// Validate username (must be alphanumeric)
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
	exit('Username is not valid!');
}
// Check username is new
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    //store resylt
    $stmt->store_result();
    // Check if the account exists
    if ($stmt->num_rows > 0) {
        // Username already exists
        echo 'Username already exists! Please choose another!';
    } else {

        $registered = date('d-m-Y H:i:s');
        //hashing
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // Username added
        if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, registered) VALUES (?, ?, ?, ?)')) {
            // Bind POST data 
            $stmt->bind_param('ssss', $_POST['username'], $password, $_POST['email'], $registered);
            $stmt->execute();
            
            echo 'You have successfully registered! You can now login!';
        } else {
            // Sql error
            echo 'Could not prepare statement!';
        }

    }
    // Close 
    $stmt->close();
} else {
    //error with sql
    echo 'Could not prepare statement!';
}
// Close 
$con->close();
?>