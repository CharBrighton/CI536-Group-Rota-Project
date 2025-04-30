<?php
session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
		<title>Register</title>
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
                        <a class="nav-link" href="manager_register_employee.php">New Employee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logic/logout_logic.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="login">

        <h1>Employee Register</h1>

        <form action="../logic/register_logic.php" method="post" class="form login-form">

            <label class="form-label" for="username">Username</label>
            <div class="form-group">
                <input class="form-input" type="text" name="username" placeholder="Username" id="username" required>
            </div>

            <label class="form-label" for="firstname">First Name</label>
            <div class="form-group">
                <input class="form-input" type="text" name="firstname" placeholder="John" id="firstname" required>
            </div>
            <label class="form-label" for="lastname">Last Name</label>
            <div class="form-group">
                <input class="form-input" type="text" name="lastname" placeholder="Smith" id="lastname" required>
            </div>
            <label class="form-label" for="firstname">Date of Birth</label>
            <div class="form-group">
                <input class="form-input" type="date" name="date"  id="date" required>
            </div>
            <label class="form-label" for="email">Email</label>
            <div class="form-group">
                <input class="form-input" type="email" name="email" placeholder="Email" id="email" required>
            </div>

            <label class="form-label" for="password">Password</label>
            <div class="form-group">
                <input class="form-input" type="password" name="password" placeholder="Password" id="password" autocomplete="new-password" required>
            </div>
            <label class="form-label" for="emplyeeType">Check if manager</label>
            <div class="form-group">
                <input class="form-input" type="checkbox" name="employeeType" id="employeetype" value="1">
            </div>

            <label class="form-label" for="payrate">Pay Rate (in pence)</label>
            <div class="form-group">
                <input class="form-input" type="text" name="payrate"  id="payrate" required>
            </div>
            <button class="btn" type="submit">Register</button>

        </form>

    </div>
	</body>
</html>