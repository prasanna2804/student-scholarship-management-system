<?php
// Database configuration
$host = "localhost";    // Server (Change if needed)
$username = "root";     // Default XAMPP MySQL username
$password = "";         // Default XAMPP MySQL password (empty)
$database = "scholarship_management"; // Database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// ✅ If connected successfully
// echo "Database connected successfully"; // (Uncomment for testing)

?>
