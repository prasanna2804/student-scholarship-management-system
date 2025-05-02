<?php
session_start();
include 'db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login_student.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch student details
$studentQuery = $conn->query("SELECT name FROM students WHERE id = $student_id");
$student = $studentQuery->fetch_assoc();
$student_name = $student['name'];

// Fetch available scholarships
$scholarshipsQuery = $conn->query("SELECT * FROM scholarships");

// Fetch student applications
$applicationsQuery = $conn->query("SELECT * FROM applications WHERE application_id = $student_id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="sd.css">
</head>
<body>
    <div class="dashboard-container">
        <header>
            <h1>Welcome, <?php echo htmlspecialchars($student_name); ?> 👋</h1>
            <a href="slogout.php" class="logout-btn">Logout</a>
        </header>

        <section class="scholarship-section">
            <h2>Available Scholarships 🎓</h2>
            <table>
                <tr>
                    <th>Scheme Name</th>
                    <th>Decription/Eligibility</th>
                    <th>Amount</th>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>
                <?php while ($scholarship = $scholarshipsQuery->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($scholarship['name']); ?></td>
                    <td><?php echo htmlspecialchars($scholarship['description']); ?></td>
                    <td>₹<?php echo number_format($scholarship['amount']); ?></td>
                    <td><?php echo htmlspecialchars($scholarship['deadline']); ?></td>
                    <td><a href="apply_scholarship.php?id=<?php echo $scholarship['id']; ?>" class="apply-btn">Apply</a></td>
                </tr>
                <?php } ?>
            </table>
        </section>

        <section class="status-section">
            <h2>My Applications 📜</h2>
            <table>
                <tr>
                    <th>Student Name</th>
                       <th>Register No</th>
                     <th>Status</th>
                    <th>Applied On</th>
                </tr>
                <?php while ($application = $applicationsQuery->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo strtolower($application['student_name']); ?></td>
                    <td><?php echo htmlspecialchars($application['student_online_id']); ?></td>
                    <td><?php echo strtolower($application['application_status']); ?></td>
                    <td><?php echo htmlspecialchars($application['created_at']); ?></td>
                </tr>
                <?php } ?>
            </table>
        </section>
    </div>
</body>
</html>


