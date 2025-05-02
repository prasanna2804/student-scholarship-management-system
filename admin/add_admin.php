<?php
include('../db.php'); // Ensure this file contains your database connection

$username = "prasanna"; 
$password = password_hash("prasanna2006", PASSWORD_BCRYPT); // Securely hash password

// Check if admin already exists
$query = "SELECT * FROM admin WHERE username='$username'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    // Insert new admin
    $insertQuery = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $insertQuery)) {
        echo "Admin user added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Admin user already exists.";
}
?>
