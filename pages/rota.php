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
        <script src="../js/rota.js"></script>
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
                        <a class="nav-link" href="rota.php?uid=<?php echo $Getuser_id ?>">Rota</a>
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


    <form id="add_name_to_day">
        <label for="names">Choose a Name:</label>
        <select name="names" id="names">
            <?php
            //show saved names
            $get_names_sql = "SELECT * FROM test_name";
            $result = mysqli_query($conn, $get_names_sql);

            while ($row = mysqli_fetch_assoc($result)) {
                //get value associated with that row and column
                $fname = $row['fname'];
                echo "<option value='$fname'>$fname</option>";
            }
            ?>
        </select>

        <label for="days">Select a Day:</label>
        <select name="days" id="days">
            <option value='monday'>Monday</option>
            <option value='tuesday'>Tuesday</option>
            <option value='wednesday'>Wednesday</option>
            <option value='thursday'>Thursday</option>
            <option value='friday'>Friday</option>
        </select>


        <input type="submit" id="submit_person" value="Submit">
    </form>

    <div class="container mt-3">
        <div class="column">
            <div class="card">
                <div class="card-header">
                    <h2>Monday</h2>
                </div>
                <div class="card-body" id="monday_card">
                    <h3>People Working:</h3>
                    <?php
                    //show saved names
                    $get_names_sql = "SELECT first_name , last_name 
                    FROM employee 
                    INNER JOIN day_availability 
                    ON employee.employee_id = day_availability.employee_id 
                    WHERE day_availability.monday = True";
                    $result = mysqli_query($conn, $get_names_sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        //get value associated with that row and column
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        echo "<p>$first_name $last_name</p>";
                    }
                    ?>
                </div>
                <div class="card-footer"></div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Tuesday</h2>
                </div>
                <div class="card-body" id="tuesday_card">
                    <h3>People Working:</h3>
                    <?php
                    //show saved names
                    $get_names_sql = "SELECT first_name , last_name 
                    FROM employee 
                    INNER JOIN day_availability 
                    ON employee.employee_id = day_availability.employee_id 
                    WHERE day_availability.tuesday = True";
                    $result = mysqli_query($conn, $get_names_sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        //get value associated with that row and column
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        echo "<p>$first_name $last_name</p>";
                    }
                    ?>
                </div>
                <div class="card-footer"></div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Wednesday</h2>
                </div>
                <div class="card-body" id="wednesday_card">
                    <h3>People Working:</h3>
                    <?php
                    //show saved names
                    $get_names_sql = "SELECT first_name , last_name 
                    FROM employee 
                    INNER JOIN day_availability 
                    ON employee.employee_id = day_availability.employee_id 
                    WHERE day_availability.wednesday = True";
                    $result = mysqli_query($conn, $get_names_sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        //get value associated with that row and column
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        echo "<p>$first_name $last_name</p>";
                    }
                    ?>
                </div>
                <div class="card-footer"></div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Thursday</h2>
                </div>
                <div class="card-body" id="thursday_card">
                    <h3>People Working:</h3>
                    <?php
                    //show saved names
                    $get_names_sql = "SELECT first_name , last_name 
                    FROM employee 
                    INNER JOIN day_availability 
                    ON employee.employee_id = day_availability.employee_id 
                    WHERE day_availability.thursday = True";
                    $result = mysqli_query($conn, $get_names_sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        //get value associated with that row and column
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        echo "<p>$first_name $last_name</p>";
                    }
                    ?>
                </div>
                <div class="card-footer"></div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Friday</h2>
                </div>
                <div class="card-body" id="friday_card">
                    <h3>People Working:</h3>
                    <?php
                    //show saved names
                    $get_names_sql = "SELECT first_name , last_name 
                    FROM employee 
                    INNER JOIN day_availability 
                    ON employee.employee_id = day_availability.employee_id 
                    WHERE day_availability.friday = True";
                    $result = mysqli_query($conn, $get_names_sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        //get value associated with that row and column
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        echo "<p>$first_name $last_name</p>";
                    }
                    ?>
                </div>
                <div class="card-footer"></div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Saturday</h2>
                </div>
                <div class="card-body" id="saturday_card">
                    <h3>People Working:</h3>
                    <?php
                    //show saved names
                    $get_names_sql = "SELECT first_name , last_name 
                    FROM employee 
                    INNER JOIN day_availability 
                    ON employee.employee_id = day_availability.employee_id 
                    WHERE day_availability.saturday = True";
                    $result = mysqli_query($conn, $get_names_sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        //get value associated with that row and column
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        echo "<p>$first_name $last_name</p>";
                    }
                    ?>
                </div>
                <div class="card-footer"></div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Sunday</h2>
                </div>
                <div class="card-body" id="sunday_card">
                    <h3>People Working:</h3>
                    <?php
                    //show saved names
                    $get_names_sql = "SELECT first_name , last_name 
                    FROM employee 
                    INNER JOIN day_availability 
                    ON employee.employee_id = day_availability.employee_id 
                    WHERE day_availability.sunday = True";
                    $result = mysqli_query($conn, $get_names_sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        //get value associated with that row and column
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        echo "<p>$first_name $last_name</p>";
                    }
                    ?>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
    </body>
    </html>