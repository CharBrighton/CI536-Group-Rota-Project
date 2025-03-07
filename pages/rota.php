<?php
//hides errors showing on the page but keep commented out for dev purposes
//error_reporting(0);
global $conn;
include "../conn/conn.php";
include '../logic/rotalogic.php';

$Getuser_id = $_GET['uid'];
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>View Names</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/rota.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../js/rota.js"></script>
    </head>

    <body>
    <div class="wrapper">
        <div class="topnav">
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
                                <a class="nav-link" href="addtorota.php?uid=<?php echo $Getuser_id ?>">Add To Rota</a>
                            </li>
                        </ul>
                        <form class="d-flex" method="post">
                            <input class="form-control me-2" type="text" placeholder="Name" name="username">
                            <button class="btn btn-primary" type="submit" name="login">Enter</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>

        <div class="main">
            <button id="prev">&#8249;</button>
            <button id="next">&#8250;</button>

            <div id="month">
                <h2 id="month"></h2>
            </div>
        </div>

        <div class="monday">
            <p id="1">Monday</p>
            <p id="mon_date"></p>
        </div>
        <div class="tuesday">
            <p id="2">Tuesday</p>
            <p id="tue_date"></p>
        </div>
        <div class="wednesday">
            <p id="3">Wednesday</p>
            <p id="wed_date"></p>
        </div>
        <div class="thursday">
            <p id="4">Thursday</p>
            <p id="thu_date"></p>
        </div>
        <div class="friday">
            <p id="5">Friday</p>
            <p id="fri_date"></p>
        </div>
        <div class="saturday">
            <p id="6">Saturday</p>
            <p id="sat_date"></p>
        </div>
        <div class="sunday">
            <p id="7">Sunday</p>
            <p id="sun_date"></p>
        </div>



    </div>
    </body>
    </html>