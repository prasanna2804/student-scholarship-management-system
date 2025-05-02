<?php
//ob_start(); // Enable output buffering
session_start();
include("db.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: login_student.php");
    exit();
}

$student_id = $_SESSION['student_id'];


$query = "SELECT * FROM applications WHERE application_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id); // use 's' if student_id is varchar
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Application already exists!";
    header("Location: acknowledgement.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scholarship Application Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 30px;
            max-width: 950px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #0A74DA;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        textarea {
            resize: vertical;
        }
        .form-section {
            margin-top: 30px;
        }
        .document-pair {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .document-pair input[type="file"], .document-pair select {
            flex: 1;
        }
        .btn-add, .btn-submit {
            margin-top: 20px;
            background-color: #0A74DA;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-add:hover, .btn-submit:hover {
            background-color: #064ea0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Scholarship Application Form</h2>
        <form action="submit_form.php" method="POST" enctype="multipart/form-data">
            <!-- Personal Details -->
            <div class="form-section">
                <label>Roll No:</label>
                <input type="text" name="roll_no" required>

                <label>Student Register No:</label>
                <input type="text" name="student_online_id" required>

                <label>College/University Name:</label>
                <input type="text" name="college" required>

                <label>Course:</label>
                <input type="text" name="course" required>

                <label>Year (Now Studying):</label>
                <select name="year" required>
                    <option value="">Select Year</option>
                    <option value="I">I</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                    <option value="IV">IV</option>
                    <option value="V">V</option>
                </select>

                <label>Name of the Student:</label>
                <input type="text" name="student_name" required>

                <label>Father's/Guardian Name:</label>
                <input type="text" name="father_guardian_name" required>

                <label>Occupation:</label>
                <input type="text" name="occupation" required>

                <label>Permanent Address:</label>
                <textarea name="address" rows="3" required></textarea>
            </div>

            <!-- Bank Details -->
            <div class="form-section">
                <h3>Bank Details</h3>
                <input type="text" name="bank_account_no" placeholder="Bank Account No" required>
                <input type="text" name="bank_name" placeholder="Bank Name" required>
                <input type="text" name="branch_name" placeholder="Branch Name" required>
                <input type="text" name="micr_code" placeholder="MICR Code" required>
                <input type="text" name="ifsc_code" placeholder="IFSC Code" required>
            </div>

            <!-- Other Info -->
            <div class="form-section">
                <label>Sex:</label>
                <select name="sex" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>

                <label>UMIS No:</label>
                <input type="text" name="umis_no" required>

                <label>Aadhaar No:</label>
                <input type="text" name="aadhaar_no" required>

                <label>Date of Birth:</label>
                <input type="date" name="date_of_birth" required>

                <label>Caste:</label>
                <input type="text" name="community" required>

                <label>Sub-Caste:</label>
                <input type="text" name="sub_caste" required>

                <label>Date of Joining:</label>
                <input type="date" name="date_of_joining" required>

                <label>Mobile No (Student):</label>
                <input type="text" name="student_mobile" required>

                <label>Mobile No (Parent):</label>
                <input type="text" name="parent_mobile" required>

                <label>Email ID:</label>
                <input type="email" name="student_email" required>

                <label>Have you received any other Scholarship?</label>
                <select name="received_other_scholarship" required>
                    <option value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>

                <label>Scholarship Name:</label>
                <select name="scholarship_name" required>
                    <option value="">Select</option>
                    <option value="Post Metric Scholarship">Post Metric Scholarship</option>
                    <option value="Merit Based Scholarship">Merit Based Scholarship</option>
                </select>

                <label>Hosteller/Day Scholar:</label>
                <select name="hosteller" required>
                    <option value="">Select</option>
                    <option value="Hosteller">Hosteller</option>
                    <option value="Day Scholar">Day Scholar</option>
                </select>
            </div>

           <!-- Document Upload Section -->
<div class="form-section">
    <h3>Upload Documents</h3>
    <div id="documentContainer">
        <div class="document-pair">
            <input type="file" name="documents[]" required>
            <select name="document_type[]" required>
                <option value="">Select Document Type</option>
                <option value="Identity Card">Identity Card</option>
                <option value="Bonafide Certificate">Bonafide Certificate</option>
                <option value="10th Marksheet">10th Marksheet</option>
                <option value="12th Marksheet">12th Marksheet</option>
                <option value="Income Certificate">Income Certificate</option>
                <option value="Community Certificate">Community Certificate</option>
                <option value="Bank Passbook">Bank Passbook</option>
                <option value="Tuition Fee Challan">Tuition Fee Challan</option>
                <option value="Aadhaar Card">Aadhaar Card</option>
                <option value="Hostel Certificate">Hostel Certificate</option>
                <option value="Attendance Certificate">Attendance Certificate</option>
                <option value="First Graduate Certificate">First Graduate Certificate</option>
            </select>
        </div>
    </div>
    <button type="button" class="btn-add" onclick="addDocumentField()">Add Another Document</button>
</div>


            <!-- Submit -->
            <button type="submit" class="btn-submit">Submit Application</button>
        </form>
    </div>

   <script>
function addDocumentField() {
    const container = document.getElementById("documentContainer");
    const html = `
        <div class="document-pair">
            <input type="file" name="documents[]" required>
            <select name="document_type[]" required>
                <option value="">Select Document Type</option>
                <option value="Identity Card">Identity Card</option>
                <option value="Bonafide Certificate">Bonafide Certificate</option>
                <option value="10th Marksheet">10th Marksheet</option>
                <option value="12th Marksheet">12th Marksheet</option>
                <option value="Income Certificate">Income Certificate</option>
                <option value="Community Certificate">Community Certificate</option>
                <option value="Bank Passbook">Bank Passbook</option>
                <option value="Tuition Fee Challan">Tuition Fee Challan</option>
                <option value="Aadhaar Card">Aadhaar Card</option>
                <option value="Hostel Certificate">Hostel Certificate</option>
                <option value="Attendance Certificate">Attendance Certificate</option>
                <option value="First Graduate Certificate">First Graduate Certificate</option>
            </select>
        </div>`;
    container.insertAdjacentHTML("beforeend", html);
}
</script>

</body>
</html>
