<?php
session_start();
include('../db.php'); // Database connection

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login_admin.php");
    exit();
}

// Fetch statistics
$totalApplications = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM applications"))['count'];
$approvedApplications = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM applications WHERE application_status='Approved'"))['count'];
$pendingApplications = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM applications WHERE application_status='Pending'"))['count'];
$rejectedApplications = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM applications WHERE application_status='Rejected'"))['count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
       <style>
<style>
    body {
        display: flex;
        background-color: #4682B4; 
        margin: 0;
        font-family: 'Poppins', sans-serif; /* Modern font */
    }
   .sidebar {
    width: 310px;
    height: 100vh;
    background: #0d6efd;
    padding-top: 30px;
    position: fixed;
    color: white;
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    overflow-y: auto; /* ⭐⭐ Add this to allow scrolling ⭐⭐ */
}
.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-thumb {
    background-color: #0056b3;
    border-radius: 10px;
}

.sidebar::-webkit-scrollbar-track {
    background: transparent;
}

    .sidebar h4 {
        color: #ffffff;
        text-align: center;
        margin-bottom: 40px;
        font-size: 24px;
        font-weight: 600;
        letter-spacing: 1px;
    }
    .sidebar a {
        display: block;
        color: #e0f0ff;
        padding: 15px 30px;
        text-decoration: none;
        font-size: 17px;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    .sidebar a:hover {
        background: #0056b3;
        color: #ffffff;
        border-radius: 0 25px 25px 0;
        padding-left: 40px;
    }
    .submenu {
        display: none;
        background: #1e7efc;
        padding-left: 40px;
    }
    .submenu a {
        font-size: 15px;
        padding: 12px 30px;
        color: #d6eaff;
    }
    .submenu a:hover {
        background: #0b5ed7;
        color: #ffffff;
        border-radius: 0 25px 25px 0;
    }
    .content {
        margin-left: 320px; /* Shift content after sidebar extension */
        padding: 40px;
        width: calc(100% - 320px);
    }
    .card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        padding: 20px;
        background: #ffffff;
    }
    h2 {
        margin-bottom: 30px;
        color: #0d6efd;
        font-weight: 600;
    }
</style>

</style>

</head>
<body>

    <div class="sidebar">
        <h4 class="text-center">Admin Panel</h4>
        <a href="admin_panel.php"><i class="fas fa-home"></i> Dashboard</a>

        <a href="#" onclick="toggleMenu('scholarshipMenu')"><i class="fas fa-graduation-cap"></i> Scholarship Management ▼</a>
        <div class="submenu" id="scholarshipMenu">
            <a href="create_scholarship.php">➤ Create Scholarship</a>
            <a href="view_scholarships.php">➤ View Scholarships</a>
            <a href="set_criteria.php">➤ Set Eligibility</a>
        </div>

        <a href="#" onclick="toggleMenu('applicationsMenu')"><i class="fas fa-file-alt"></i> Student Applications ▼</a>
        <div class="submenu" id="applicationsMenu">
            <a href="pending_applications.php">➤ Pending Applications</a>
            <a href="approved_applications.php">➤ Approved Applications</a>
            <a href="rejected_applications.php">➤ Rejected Applications</a>
        </div>

        <a href="#" onclick="toggleMenu('studentsMenu')"><i class="fas fa-user-graduate"></i> Student Management ▼</a>
        <div class="submenu" id="studentsMenu">
            <a href="view_students.php">➤ View Students</a>
          
        </div>

        
<a href="reports.php"><i class="fas fa-chart-line"></i> Reports & Analytics</a>


        <a href="#" onclick="toggleMenu('settingsMenu')"><i class="fas fa-cog"></i> Settings ▼</a>
        <div class="submenu" id="settingsMenu">
            <a href="change_password.php">➤ Change Password</a>
            <a href="admin_logout.php" class="text-danger" style="color:#2c0d0d;"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>

       
        <a href="help.php"><i class="fas fa-question-circle"></i> Help & Support</a>
    </div>

    <div class="content">
        <h2>Welcome, Admin!</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Applications</h5>
                        <p class="card-text"><?php echo $totalApplications; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Approved</h5>
                        <p class="card-text"><?php echo $approvedApplications; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pending</h5>
                        <p class="card-text"><?php echo $pendingApplications; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Rejected</h5>
                        <p class="card-text"><?php echo $rejectedApplications; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

       <script>
        function toggleMenu(menuId) {
            var menu = document.getElementById(menuId);
            if (menu.style.display === "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        }
    </script>


</body>
</html>
