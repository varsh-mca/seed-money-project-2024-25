<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Correct redirection to the login page
header("Location: ./staff_login.html"); // Go one level up to main 'seed' folder
exit();
?>
