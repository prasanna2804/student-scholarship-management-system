<?php
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('../db.php'); // Your database connection

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

$admin_id = $_SESSION['admin_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Fetch current password from database
    $query = "SELECT password FROM admin WHERE id = '$admin_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($current_password, $row['password'])) {
            if ($new_password === $confirm_password) {
                // Hash new password
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update password
                $update_query = "UPDATE admin SET password = '$hashed_new_password' WHERE id = '$admin_id'";
                if (mysqli_query($conn, $update_query)) {
                    // Success! Logout admin and force re-login
                    echo "<script>
                        alert('Password updated successfully! Please login again.');
                        window.location.href = 'login_admin.php';
                    </script>";
                    session_destroy();
                    exit();
                } else {
                    echo "<script>alert('Error updating password.');</script>";
                }
            } else {
                echo "<script>alert('New password and Confirm password do not match.');</script>";
            }
        } else {
            echo "<script>alert('Current password is incorrect.');</script>";
        }
    } else {
        echo "<script>alert('Admin not found.');</script>";
    }
}
?>

<!-- HTML Part -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="../lra.css">
</head>
<body>
    <div class="container">
        <h2 style="text-align:center;">Change Password</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" required placeholder="Enter current password">
            </div>
            <div class="mb-3">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" required placeholder="Enter new password">
            </div>
            <div class="mb-3">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm new password">
            </div>
            <button type="submit">Change Password</button>
        </form>
    </div>
</body>
</html>
