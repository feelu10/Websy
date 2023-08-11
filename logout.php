<?php

session_start();

if (!isset($_SESSION['username'])) {
    // The user is already logged out
    $_SESSION['message'] = "You are already logged out";
    header('Location: index.php');
    exit;
}


// Log the user out
unset($_SESSION['username']);
$_SESSION['logged_in'] = false;

$_SESSION['message'] = "You have been logged out successfully";
header("Location: login.php?message=You have been successfully logged out.");
exit;
?>
