<?php
session_start();
include('../db.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login_admin.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM applications WHERE application_status='Approved'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Approved Applications</title>
    <style>
/* Set background color */
body {
    background-color: #87CEFA; /* Light Sky Blue */
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
}

/* Center the title */
h2 {
    text-align: center;
    color: #333;
}

/* Style the table */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    overflow: hidden;
}

/* Table headers */
th {
    background: #4682B4; /* Steel Blue */
    color: white;
    padding: 12px;
    text-align: left;
}

/* Table rows */
td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

/* Alternating row colors */
tr:nth-child(even) {
    background: #f2f2f2;
}

/* Hover effect */
tr:hover {
    background: #dbeeff;
    transition: 0.3s;
}

/* Links inside the table */
a {
    text-decoration: none;
    color: #007BFF;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

/* Button styling */
button {
    background: #28a745;
    color: white;
    padding: 8px 12px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}

button:hover {
    background: #218838;
}

</style>
</head>
<body>
    <div class="container mt-5">
        <h2>Approved Applications</h2>
        <table class="table table-bordered">
            <tr>
                <th>Student Name</th>
                <th>Email</th>
                  <th>Scholarship Name</th>
                 <th>Application Date</th>
                 <th>Application Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['student_name']; ?></td>
                    <td><?php echo $row['student_email']; ?></td>
                    <td><?php echo $row['scholarship_name']; ?></td> 
                    <td><?php echo $row['created_at']; ?></td>
                   <td><?php echo $row['application_status']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>