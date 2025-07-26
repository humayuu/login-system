<?php 
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: index.php?loginError=1");
    exit;
}

session_unset();

session_destroy();

header("Location: index.php?logout=1");
exit;