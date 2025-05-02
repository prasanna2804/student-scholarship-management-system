<?php
session_start();
include('db.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login_admin.php");
    exit();
}

// Check if scholarship ID is provided
if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid request!'); window.location.href='view_scholarships.php';</script>";
    exit();
}

$id = $_GET['id'];
$query = "DELETE FROM scholarships WHERE id = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Scholarship deleted successfully!'); window.location.href='view_scholarships.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
