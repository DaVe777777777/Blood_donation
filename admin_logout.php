<?php 
session_start();

include 'connection.php';

if(!empty($_SESSION['admin_username'])) {
    $username = $_SESSION['admin_username'];

    // Insert logout log into the database
    $logTime = date("Y-m-d H:i:s"); // Get current date and time
    $logActivity = "OUT"; // Indicates logout
    $insertLogQuery = "INSERT INTO admin_log (admin_name, activity, login_time) VALUES ('$username', '$logActivity', '$logTime')";
    $conn->query($insertLogQuery);

    // Destroy the session
    session_destroy();
}

// Redirect to login page after logout
header('location: admin_login.php');
exit;

?>