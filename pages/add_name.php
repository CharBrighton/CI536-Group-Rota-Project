<?php
global $conn;
include "../conn/conn.php";
$Getuser_id = $_GET['uid'];
?>

<html lang="en">
<head>
    <title>Add Name</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?uid=<?php echo $Getuser_id ?>">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?uid=<?php echo $Getuser_id ?>">View Names</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rota.php?uid=<?php echo $Getuser_id ?>">Rota</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid pt-5 bg-light text-black">
    <h2>Add A Name To test_name Database</h2>
    <form method="post">
        <label>First Name</label>
        <input type="text" placeholder="First Name" name="fname" required>
        <label>Last Name</label>
        <input type="text" placeholder="Last Name" name="lname" required>
        <label>Age</label>
        <input type="text" placeholder="Age" name="age" required>
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    // Get inputs
    $fname = $_POST ['fname'];
    $lname = $_POST ['lname'];
    $age = $_POST['age'];

    $insert_sql = "INSERT INTO test_name (fname, lname, age) VALUES ('$fname', '$lname', '$age')";

    if ($conn->query($insert_sql) !== TRUE) {
        echo "error" . $insert_sql . "<br>" . $conn->error;
    } else {
        ?>
        <html>
        <script>
            alert("Name Added")
        </script>
        </html>
        <?php
    }
}

?>
