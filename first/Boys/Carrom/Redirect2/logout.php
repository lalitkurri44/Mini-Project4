<?php
session_start(); // Start the session to access session variables

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: ../cr/login.php");
exit(); // Ensure no further code is executed
?>
