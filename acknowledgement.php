<?php
session_start();
include("db.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: login_student.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch application details
$query = "SELECT * FROM applications WHERE application_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "No application found!";
    exit();
}

$application = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acknowledgement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #ffeb3b;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 10px;
            border: 1px solid white;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #ff9800;
            color: black;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.2);
        }

        button {
            background-color: #ffeb3b;
            color: black;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
            margin-top: 20px;
        }

        button:hover {
            background-color: #ffc107;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Application Submitted Successfully!</h2>

        <table>
            <tr>
                <th>Field</th>
                <th>Details</th>
            </tr>
            <tr>
                <td><strong>Student ID</strong></td>
                <td><?php echo $application['student_id']; ?></td>
            </tr>
            <tr>
                <td><strong>Roll No</strong></td>
                <td><?php echo $application['roll_no']; ?></td>
            </tr>
            <tr>
                <td><strong>Register No</strong></td>
                <td><?php echo $application['student_online_id']; ?></td>
            </tr>
<tr>
                <td><strong>College/University Name</strong></td>
                <td><?php echo $application['college']; ?></td>
            </tr>
            <tr>
                <td><strong>Course</strong></td>
                <td><?php echo $application['course']; ?></td>
            </tr>
            <tr>
                <td><strong>Year</strong></td>
                <td><?php echo $application['year']; ?></td>
            </tr>
            <tr>
                <td><strong>Student Name</strong></td>
                <td><?php echo $application['student_name']; ?></td>
            </tr>
            <tr>
                <td><strong>Father/Guardian Name</strong></td>
                <td><?php echo $application['father_guardian_name']; ?></td>
            </tr>
            <tr>
                <td><strong>Father/Guardian Occupation</strong></td>
                <td><?php echo $application['occupation']; ?></td>
            </tr>
            <tr>
                <td><strong>Address</strong></td>
                <td><?php echo $application['address']; ?></td>
            </tr>
            <tr>
                <td><strong>Bank Account No</strong></td>
                <td><?php echo $application['bank_account_no']; ?></td>
            </tr>
            <tr>
                <td><strong>Bank Name</strong></td>
                <td><?php echo $application['bank_name']; ?></td>
            </tr>
            <tr>
                <td><strong>Branch Name</strong></td>
                <td><?php echo $application['branch_name']; ?></td>
            </tr>
            <tr>
                <td><strong>MICR Code</strong></td>
                <td><?php echo $application['micr_code']; ?></td>
            </tr>
            <tr>
                <td><strong>IFSC Code</strong></td>
                <td><?php echo $application['ifsc_code']; ?></td>
            </tr>
            <tr>
                <td><strong>Gender</strong></td>
                <td><?php echo $application['sex']; ?></td>
            </tr>
<tr>
                <td><strong>Umis Number</strong></td>
                <td><?php echo $application['umis_no']; ?></td>
            </tr>
<tr>
                <td><strong>Aadhar Number</strong></td>
                <td><?php echo $application['aadhaar_no']; ?></td>
            </tr>
<tr>
                <td><strong>Date Of Birth</strong></td>
                <td><?php echo $application['date_of_birth']; ?></td>
            </tr>
<tr>
                <td><strong>Community</strong></td>
                <td><?php echo $application['community']; ?></td>
            </tr>
<tr>
                <td><strong>Sub Caste</strong></td>
                <td><?php echo $application['sub_caste']; ?></td>
            </tr>
<tr>
                <td><strong>Date Of Joining</strong></td>
                <td><?php echo $application['date_of_joining']; ?></td>
            </tr>
<tr>
                <td><strong>Student Mobile No</strong></td>
                <td><?php echo $application['student_mobile']; ?></td>
            </tr>
<tr>
                <td><strong>Parent Mobile No</strong></td>
                <td><?php echo $application['parent_mobile']; ?></td>
            </tr>
<tr>
                <td><strong>Student Email</strong></td>
                <td><?php echo $application['student_email']; ?></td>
            </tr>
            <tr>
<tr>
                <td><strong>Recieved Other Scholarship</strong></td>
                <td><?php echo $application['received_other_scholarship']; ?></td>
            </tr>
<tr>
                <td><strong>Scholarship Name</strong></td>
                <td><?php echo $application['scholarship_name']; ?></td>
            </tr>
<tr>
                <td><strong>Hosteller</strong></td>
                <td><?php echo $application['hosteller']; ?></td>
            </tr>
                <td><strong>Application Status</strong></td>
                <td>Submitted</td>
            </tr>
        </table>

        <a href="download_acknowledgement.php" target="_blank">
            <button>Download Acknowledgement (PDF)</button>
        </a>
    </div>
</body>
</html>
