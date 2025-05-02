<?php
session_start();
include('db.php'); // Database connection

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login_admin.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = $_GET['status'];

    // Update application status
    $query = "UPDATE applications SET application_status='$status' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Application updated successfully'); window.location.href='admin_panel.php';</script>";
    } else {
        echo "<script>alert('Error updating application'); window.location.href='admin_panel.php';</script>";
    }
}
?>
