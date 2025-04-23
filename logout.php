<?php
// Start the session
session_start();
// Destroy the active session
session_destroy();
// Redirect to the login pag
header('Location: index.php');
exit;
?>
