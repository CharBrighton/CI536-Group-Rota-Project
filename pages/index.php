<?php
//hides errors showing on the page but keep commented out for dev purposes
//error_reporting(0);
global $conn;
include "../conn/conn.php";
$Getuser_id = $_GET['uid'];
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>View Names</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../js/index.js"></script>
    </head>

    <body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?uid=<?php echo $Getuser_id ?>">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="add_name.php?uid=<?php echo $Getuser_id ?>">Add Name</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?uid=<?php echo $Getuser_id ?>">Item2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?uid=<?php echo $Getuser_id ?>">Item3</a>
                    </li>
                </ul>
                <form class="d-flex" method="post">
                    <input class="form-control me-2" type="text" placeholder="Name" name="username">
                    <button class="btn btn-primary" type="submit" name="login">Enter</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid pt-5 bg-light text-black">
        <h2>Names Pulled From test_name Database</h2>
        <?php
        //show saved names
        $get_names_sql = "SELECT * FROM test_name";
        $result = mysqli_query($conn, $get_names_sql);

        while ($row = mysqli_fetch_assoc($result)) {
            //get value associated with that row and column
            $fname = $row['fname'];
            $lname = $row['lname'];
            $age = $row['age'];
            echo "<div class='pt-5'> First Name: " . $row["fname"] . " <br>Last Name: " . $row["lname"] . " <br>Age: " . $row["age"] . "</div>";
        }
        ?>
    </div>
    </body>
    </html>

<?php
if (isset($_POST['login'])) {
    $username = $_POST ['username'];
    $get_id_sql = "SELECT * FROM test_name WHERE fname = '$username'";
    $result = mysqli_query($conn, $get_id_sql);
    $row = mysqli_fetch_assoc($result);
    $result_num_rows = mysqli_num_rows($result);
    if ($result_num_rows > 0) {
        $user_id = $row['id'];
        $URL = "index.php?uid=$user_id";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    } else {
        $URL = "index.php?uid=";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    }
}
?>