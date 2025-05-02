<?php
session_start();
include('../db.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login_admin.php");
    exit();
}

// Fetch scholarships
$result = mysqli_query($conn, "SELECT * FROM scholarships");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Scholarships</title>
    <link rel="stylesheet" href="admin_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style> 
      /* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background: #6CB4EE;
    margin: 0;
    padding: 0;
}

/* Container Styling */
.container {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin-top: 50px;
}

/* Headings */
h2 {
    text-align: center;
    font-weight: 600;
    color: #007bff;
    margin-bottom: 20px;
}

/* Form Inputs */
.form-control {
    border-radius: 5px;
    border: 1px solid #007bff;
    transition: 0.3s;
}

.form-control:focus {
    border-color: #6610f2;
    box-shadow: 0px 0px 8px rgba(102, 16, 242, 0.4);
}

/* Labels */
label {
    font-weight: bold;
    color: #495057;
}

/* Buttons */
.btn-primary {
    background-color: #007bff;
    border: none;
    padding: 10px;
    font-size: 16px;
    transition: 0.3s;
}

.btn-primary:hover {
    background-color: #6610f2;
}

/* Table Styling */
.table {
    border-radius: 10px;
    overflow: hidden;
}

.table th {
    background: #007bff;
    color: white;
    text-align: center;
    padding: 10px;
}

.table td {
    text-align: center;
    padding: 10px;
}

/* Action Buttons */
.btn-warning {
    background-color: #ffae42;
    border: none;
}

.btn-danger {
    background-color: #dc3545;
    border: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        margin-top: 20px;
    }
    
    .table {
        font-size: 14px;
    }
}

    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>All Scholarships</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount (₹)</th>
                    <th>Deadline</th>
                    <th>Eligibility</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['deadline']; ?></td>
                        <td><?php echo $row['eligibility']; ?></td>
                        <td>
                          <a href="edit_scholarship.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                         <a href="delete_scholarship.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this scholarship?')">Delete</a>
                        </td>  
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
