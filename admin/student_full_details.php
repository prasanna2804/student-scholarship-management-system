<?php
include '../db.php'; // Your DB connection file

if (isset($_GET['student_id'])) {
    $application_id = intval($_GET['student_id']);

    // Fetch application + student details
    $query = "SELECT * FROM applications WHERE student_id= $application_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $app = mysqli_fetch_assoc($result);

        // Fetch uploaded documents
        $doc_query = "SELECT * FROM documents WHERE student_id = $application_id";
        $doc_result = mysqli_query($conn, $doc_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Application Details</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #87CEFA; /* Light sky blue */
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #007bb5; /* Sky blue darker */
            margin-bottom: 30px;
        }
        .section {
            background: #ffffff;
            border: 1px solid #b2ebf2;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 123, 181, 0.2);
            margin-bottom: 25px;
            padding: 20px;
        }
        .section h2 {
            color: #0097a7;
            border-bottom: 2px solid #b2ebf2;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            text-align: left;
            color: #0277bd;
            padding: 10px;
            background: #b2ebf2;
        }
        td {
            padding: 10px;
            background: #e0f7fa;
            border-bottom: 1px solid #b2ebf2;
        }
        a {
            color: #0288d1;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Student Scholarship Application Details</h1>

    <div class="section">
        <h2>Student Details</h2>
        <table>
<tr><th>Student Name</th><td><?php echo htmlspecialchars($app['student_name']); ?></td></tr>
<tr><th>Register No</th><td><?php echo htmlspecialchars($app['student_online_id']); ?></td></tr>
<tr><th>Roll No</th><td><?php echo htmlspecialchars($app['roll_no']); ?></td></tr>
            <tr><th>College/University Name</th><td><?php echo htmlspecialchars($app['college']); ?></td></tr>
            <tr><th>Course</th><td><?php echo htmlspecialchars($app['course']); ?></td></tr>
<tr><th>Academic Year</th><td><?php echo htmlspecialchars($app['year']); ?></td></tr>
<tr><th>Umis No</th><td><?php echo htmlspecialchars($app['umis_no']); ?></td></tr>
<tr><th>Aadhar No</th><td><?php echo htmlspecialchars($app['aadhaar_no']); ?></td></tr>
<tr><th>Date Of Birth</th><td><?php echo htmlspecialchars($app['date_of_birth']); ?></td></tr>
<tr><th>Gender</th><td><?php echo htmlspecialchars($app['sex']); ?></td></tr>
<tr><th>Student Mobile No</th><td><?php echo htmlspecialchars($app['student_mobile']); ?></td></tr>
<tr><th>Student Email Id</th><td><?php echo htmlspecialchars($app['student_email']); ?></td></tr>
<tr><th>Father Name</th><td><?php echo htmlspecialchars($app['father_guardian_name']); ?></td></tr>
<tr><th>Father Occupation</th><td><?php echo htmlspecialchars($app['occupation']); ?></td></tr>
<tr><th>Parent Mobile No</th><td><?php echo htmlspecialchars($app['parent_mobile']); ?></td></tr>
<tr><th>Address</th><td><?php echo htmlspecialchars($app['address']); ?></td></tr>
            <tr><th>Community</th><td><?php echo htmlspecialchars($app['community']); ?></td></tr>
<tr><th>Sub Caste</th><td><?php echo htmlspecialchars($app['sub_caste']); ?></td></tr>
            <tr><th>Hosteller</th><td><?php echo htmlspecialchars($app['hosteller']); ?></td></tr>
        </table>
    </div>

 <div class="section">
        <h2>Student Bank Details</h2>
        <table>
            <tr><th>Bank Account No</th><td><?php echo htmlspecialchars($app['bank_account_no']); ?></td></tr>
            <tr><th>Bank Name</th><td><?php echo htmlspecialchars($app['bank_name']); ?></td></tr>
 <tr><th>Branch Name</th><td><?php echo htmlspecialchars($app['branch_name']); ?></td></tr>
 <tr><th>MICR Code</th><td><?php echo htmlspecialchars($app['micr_code']); ?></td></tr>
 <tr><th>IFSC Code</th><td><?php echo htmlspecialchars($app['ifsc_code']); ?></td></tr>
        </table>
    </div>

    <div class="section">
        <h2>Scholarship Details</h2>
        <table>
            <tr><th>Scholarship Name</th><td><?php echo htmlspecialchars($app['scholarship_name']); ?></td></tr>
            <tr><th>Application Status</th><td><?php echo htmlspecialchars($app['application_status']); ?></td></tr>
 <tr><th>Received Other Scholarship</th><td><?php echo htmlspecialchars($app['received_other_scholarship']); ?></td></tr>
        </table>
    </div>

    <div class="section">
        <h2>Uploaded Documents</h2>
        <table>
            <thead>
                <tr>
                    <th>Document Type</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($doc_result && mysqli_num_rows($doc_result) > 0) {
                    while ($doc = mysqli_fetch_assoc($doc_result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($doc['document_type']) . "</td>";
                        echo "<td><a href='" . htmlspecialchars($doc['file_path']) . "' target='_blank'>View</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No documents uploaded.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
<?php
    } else {
        echo "Application not found.";
    }
} else {
    echo "Invalid Request.";
}
?>
