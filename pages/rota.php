<?php
//hides errors showing on the page but keep commented out for dev purposes
//error_reporting(0);
global $conn;
include "../conn/conn.php";
include '../logic/rotalogic.php';
include '../logic/getshiftsforday.php';

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
    <script src="../js/rota2.js"></script>
    <script src="../js/moment.js"></script>
</head>

<body>
<div class="wrapper">
    <div class="topnav">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php?uid=<?php echo $Getuser_id ?>">Logo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapsibleNavbar">
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
        <div class="buttons">
        <button id="prev">&#8249;</button>
        <button id="today">Today</button>
        <button id="next">&#8250;</button>
        </div>

        <div id="month"></div>
    </div>

    <div class="monday" id="monday">
        <p id="1">Monday</p>
        <p id="Mon_date"></p>
        <h3>Monday Shifts</h3>
        <div id="mon_results">
            <script>
                setTimeout(function(){
                    let x = document.getElementById('Mon_date').getAttribute('data-value');
                    console.log(x);

                    var dataToSend = "date=" + encodeURIComponent(x);
                    // Prepare the data to send
                    var xhr = new XMLHttpRequest();
                    // Create a new XMLHttpRequest object
                    xhr.open("POST", "../logic/getshiftsforday.php", true);
                    // Specify the request method, PHP script URL, and asynchronous
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    // Set the content type
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            // Check if the request is complete
                            if (xhr.status === 200) {
                                // Check if the request was successful
                                console.log(xhr.responseText);
                                // Output the response from the PHP script
                                const para = document.getElementById('mon_results');
                                para.innerHTML = xhr.responseText;
                                document.getElementById('mon_results').appendChild(para);
                            } else {
                                console.error("Error:", xhr.status);
                                // Log an error if the request was unsuccessful
                            }
                        }
                    };
                    xhr.send(dataToSend);
                    // Send the data to the PHP script
                    },1000)
                </script>
        </div>
    </div>
    <div class="tuesday" id="tuesday">
        <p id="2">Tuesday</p>
        <p id="Tue_date"></p>
        <h3>Tuesday Shifts</h3>
    </div>
    <div class="wednesday" id="wednesday">
        <p id="3">Wednesday</p>
        <p id="Wed_date"></p>
        <h3>Wednesday Shifts</h3>
    </div>
    <div class="thursday" id="thursday">
        <p id="4">Thursday</p>
        <p id="Thu_date"></p>
        <h3>Thursday Shifts</h3>
    </div>
    <div class="friday" id="friday">
        <p id="5">Friday</p>
        <p id="Fri_date"></p>
        <h3>Friday Shifts</h3>
    </div>
    <div class="saturday" id="saturday">
        <p id="6">Saturday</p>
        <p id="Sat_date"></p>
        <h3>Saturday Shifts</h3>
    </div>
    <div class="sunday" id="sunday">
        <p id="7">Sunday</p>
        <p id="Sun_date"></p>
        <h3>Sunday Shifts</h3>
    </div>


</div>
</body>
</html>