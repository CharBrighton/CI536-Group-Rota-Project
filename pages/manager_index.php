<?php
//hides errors showing on the page but keep commented out for dev purposes
//error_reporting(0);
global $conn;
include "../conn/conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manager Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/manager_index.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="manager_index.php">Logo (Manager Portal)</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="manager_rota.php">Full Rota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manager_shiftmanager.php">Manage Rota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manager_timeoff.php">Manage Time Off</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manager_createemployee.php">Manage Time Off</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div>
    <h1>Welcome, ADDNAME!</h1>
    <p>This manager portal is an easy way for you to view rotas, add people to rotas and approve leave.</p>
</div>

</body>
</html>