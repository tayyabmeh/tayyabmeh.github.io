<?php
session_start();
include 'actions/sweetalert.php';

$host = "localhost";
$user = "root";
$password = "";
$database = "resumebuilder";

$con = new mysqli($host, $user, $password, $database);
if ($con->connect_error) {
    die("❌ Connection failed: " . $con->connect_error);
}

// Check for token
if (!isset($_GET['token'])) {
    showSweetAlert(
        "error",
        "Invalid Request",
        "No token provided.",
        "register.php"
    );
    exit();
}

$token = $_GET['token'];

// Look up token in pending_users
$query = "SELECT * FROM pending_users WHERE token = '$token'";
$result = $con->query($query);

if (!$result) {
    showSweetAlert(
        "error",
        "SQL Error",
        "Something went wrong with the database query.",
        "register.php"
    );
    exit();
}

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $username = $row['username'];
    $email = $row['email'];
    $password = $row['password'];

    // Move to user table
    $insert = "INSERT INTO user (name, username, email, password) VALUES ('$name', '$username', '$email', '$password')";
    if ($con->query($insert)) {
        // Delete from pending_users
        $delete = "DELETE FROM pending_users WHERE token = '$token'";
        $con->query($delete); // Optional to check for delete success

        showSweetAlert(
            "success",
            "Verified!",
            "Your email is verified. You can now log in.",
            "login.php"
        );
    } else {
        showSweetAlert(
            "error",
            "Database Error",
            "Could not complete verification.",
            "register.php"
        );
    }
} else {
    showSweetAlert(
        "error",
        "Invalid Token",
        "Verification link is invalid or expired.",
        "register.php"
    );
}

$con->close();
?>
