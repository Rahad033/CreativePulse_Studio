<?php
// Local XAMPP MySQL Server Credentials
$host   = "localhost";      // Your own computer
$user   = "root";           // Default XAMPP MySQL username
$pass   = "";               // Default XAMPP MySQL password (blank)
$dbname = "agency_portal";  // Your local database name

// Connect to local MySQL
$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>