<?php
session_start();
// redirect to login
if (!isset($_SESSION['account_loggedin'])) {
    header('Location: pages/manager_index.php');
    exit;
} else {
    try {
        $isManager = $_SESSION['manager'];
        header('Location: pages/manager_index.php');
        exit;
    } catch (Exception $e) {
        header('Location: pages/employee_index.php');
        exit;
    }
}