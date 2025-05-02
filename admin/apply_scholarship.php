<?php
session_start();
include("db.php"); // Ensure this file connects to your database

if (!isset($_SESSION['student_id'])) {
    header("Location: login_student.php"); // Redirect if not logged in
    exit();
}

$student_id = $_SESSION['student_id'];

// Check if the student has already applied
$query = "SELECT * FROM applications WHERE student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Redirect to acknowledgement if application exists
    header("Location: acknowledgement.php");
    exit();
}

// If no application exists, show the form
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Application Form</title>
    <link rel="stylesheet" href="sf.css">
</head>
<body>
    <div class="container">
        <h2>Student Scholarship Application Form</h2>
        <form action="submit_form.php" method="POST" enctype="multipart/form-data">
            
            <label>Roll No:</label>
            <input type="text" name="roll_no" required>

            <label>Student register No:</label>
            <input type="text" name="student_online_id" required>
            
            <label>College/University Name:</label>
            <input type="text" name="college" required>

            <label>Course:</label>
            <input type="text" name="course" required>

            <label>Year (Now Studying):</label>
            <select name="year">
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
            <label>Father's/Guardian Occupation:</label>
            <input type="text" name="occupation" required>

            <label>Permanent Address:(d.no village,taluk,district,pin code)</label>
            <textarea name="address" required></textarea>

            <label>Bank Details:</label>
            <input type="text" name="bank_account_no" placeholder="Bank Account No" required>
            <input type="text" name="bank_name" placeholder="Bank Name" required>
            <input type="text" name="branch_name" placeholder="Branch Name" required>
            <input type="text" name="micr_code" placeholder="MICR Code" required>
            <input type="text" name="ifsc_code" placeholder="IFSC Code" required>

            <label>Sex:</label>
            <select name="sex">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
             <label>Umis No:</label>
            <input type="text" name="umis_no" required>

            <label>Aadhaar No:</label>
            <input type="text" name="aadhaar_no" required>
            
            <label>Date of Birth:</label>
            <input type="date" name="date_of_birth" required>
            
            <label>Caste:</label>
            <input type="text" name="community" required>

            <label>Sub-Caste:</label>
            <input type="text" name="sub_caste" required>

            <label>date of joining:</label>
            <input type="date" name="date_of_joining" required>


            <label>Mobile No (Student):</label>
            <input type="text" name="student_mobile" required>

            <label>Mobile No (Parent):</label>
            <input type="text" name="parent_mobile" required>

            <label>Email Id</label>
            <input type="text" name="student_email" required>

            <label>Have you received any other Scholarship?</label>
            <select name="received_other_scholarship">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
         
            <label>Scholarship Name</label>
            <select name="scholarship_name">
                <option value="Yes">Post Metric Scholarship</option>
                <option value="No">Merit Based Scholarship</option>
            </select>
            
            <label>Hosteller/Day Scholar:</label>
            <select name="hosteller">
                <option value="Hosteller">Hosteller</option>
                <option value="Day Scholar">Day Scholar</option>
            </select>
            
            
           <form action="submit_form.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="application_id" value="1"> <!-- Replace with dynamic application ID -->
    
 <label for="documents">Upload Documents:</label>
<input type="file" name="documents[]" multiple required>

<div id="documentTypesContainer">
    <label for="document_types">Select Document Type(s):</label>
</div>

<button type="button" onclick="addDocumentType()">Add Another Document Type</button>

<script>
function addDocumentType() {
    var container = document.getElementById('documentTypesContainer');
    var select = document.createElement("select");
    select.name = "document_types[]";
    select.innerHTML = `
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
    `;
    container.appendChild(select);
}
</script>
   <a href=submit_form.php> <button type="submit" >Upload</button></a>
</form>
</form>
    </div>
</body>
</html>
