<?php
include('../db.php'); // Make sure DB connection file is included
session_start();

// Optional: Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

// Fetch counts
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM applications"))['total'];
$approved = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS approved FROM applications WHERE application_status = 'approved'"))['approved'];
$rejected = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS rejected FROM applications WHERE application_status = 'rejected'"))['rejected'];
$disbursed = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(scholarship_amount) AS total_disbursed FROM applications WHERE application_status = 'approved'"))['total_disbursed'];

// Applications by month
$monthlyData = [];
$result = mysqli_query($conn, "SELECT MONTHNAME(created_at) as month, COUNT(*) as count FROM applications GROUP BY MONTH(created_at)");
while ($row = mysqli_fetch_assoc($result)) {
    $monthlyData[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reports & Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial; background: #f9f9f9; padding: 20px; }
        h1 { text-align: center; }
        .stats { display: flex; justify-content: space-around; margin: 30px 0; }
        .stat { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); width: 22%; text-align: center; }
        .stat h2 { margin: 10px 0; font-size: 30px; }
        .charts { width: 80%; margin: auto; }
        canvas { margin-top: 50px; background: white; padding: 20px; border-radius: 10px; }
    </style>
</head>
<body>

<h1>📈 Reports & Analytics</h1>

<div class="stats">
    <div class="stat">
        <h3>Total Applications</h3>
        <h2><?= $total ?></h2>
    </div>
    <div class="stat">
        <h3>Approved</h3>
        <h2><?= $approved ?></h2>
    </div>
    <div class="stat">
        <h3>Rejected</h3>
        <h2><?= $rejected ?></h2>
    </div>
    <div class="stat">
        <h3>Disbursed ₹</h3>
        <h2><?= number_format($disbursed ?? 0, 2) ?></h2>
    </div>
</div>

<div class="charts">
    <canvas id="statusChart"></canvas>
    <canvas id="monthChart"></canvas>
</div>

<script>
const statusChart = new Chart(document.getElementById('statusChart'), {
    type: 'pie',
    data: {
        labels: ['Approved', 'Rejected', 'Pending'],
        datasets: [{
            data: [<?= $approved ?>, <?= $rejected ?>, <?= $total - $approved - $rejected ?>],
            backgroundColor: ['#4CAF50', '#f44336', '#ff9800'],
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: { display: true, text: 'Application Status Distribution' }
        }
    }
});

const monthChart = new Chart(document.getElementById('monthChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($monthlyData, 'month')) ?>,
        datasets: [{
            label: 'Applications',
            data: <?= json_encode(array_column($monthlyData, 'count')) ?>,
            backgroundColor: '#2196F3'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: { display: true, text: 'Applications Received by Month' }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>

</body>
</html>
