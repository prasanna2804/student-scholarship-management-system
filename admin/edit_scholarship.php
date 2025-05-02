<?php
session_start();
include('../db.php');

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
$query = "SELECT * FROM scholarships WHERE id = $id";
$result = mysqli_query($conn, $query);
$scholarship = mysqli_fetch_assoc($result);

// Handle form submission for update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
    $eligibility = mysqli_real_escape_string($conn, $_POST['eligibility']);

    $updateQuery = "UPDATE scholarships SET 
                    name='$name', description='$description', amount='$amount', 
                    deadline='$deadline', eligibility='$eligibility' 
                    WHERE id=$id";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Scholarship updated successfully!'); window.location.href='view_scholarships.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Scholarship</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
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
        <h2>Edit Scholarship</h2>
        <form method="post">
            <div class="mb-3">
                <label>Scholarship Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $scholarship['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" required><?php echo $scholarship['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label>Amount (₹)</label>
                <input type="number" name="amount" class="form-control" value="<?php echo $scholarship['amount']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Application Deadline</label>
                <input type="date" name="deadline" class="form-control" value="<?php echo $scholarship['deadline']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Eligibility Criteria</label>
                <textarea name="eligibility" class="form-control" required><?php echo $scholarship['eligibility']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Scholarship</button>
            <a href="view_scholarships.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
