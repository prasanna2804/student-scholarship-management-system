<?php
require_once(__DIR__ . "/tcpdf/tcpdf.php");  // Include TCPDF library
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
    die("No application found!");
}

$application = $result->fetch_assoc();

// Create PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Scholarship System');
$pdf->SetTitle('Scholarship Acknowledgement');
$pdf->AddPage();

// Content for PDF
$html = "
<style>
    h2 { text-align: center; color: blue; font-size: 20px; }
    p { font-size: 14px; color: #333; }
    .info-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    .info-table th, .info-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    .info-table th { background-color: #007BFF; color: white; }
    .footer { text-align: center; margin-top: 20px; font-size: 12px; color: gray; }
</style>

<h2>Scholarship Application Acknowledgment</h2>



<table class='info-table'>
<tr><th>Student ID</th><td>{$application['student_id']}</td></tr>
<tr><th>Roll No</th><td>{$application['roll_no']}</td></tr>
<tr><th>Register No</th><td>{$application['student_online_id']}</td></tr>
<tr><th>College/University Name</th><td>{$application['college']}</td></tr>
<tr><th>Course</th><td>{$application['course']}</td></tr>
<tr><th>Year</th><td>{$application['year']}</td></tr>
<tr><th>Student Name</th><td>{$application['student_name']}</td></tr>
<tr><th>Father's Name</th><td>{$application['father_guardian_name']}</td></tr>
<tr><th>Occupation</th><td>{$application['occupation']}</td></tr>
<tr><th>Address</th><td>{$application['address']}</td></tr>
<tr><th>Bank Account No</th><td>{$application['bank_account_no']}</td></tr>
<tr><th>Bank Name</th><td>{$application['bank_name']}</td></tr>
<tr><th>Branch Name</th><td>{$application['branch_name']}</td></tr>
<tr><th>MICR Code</th><td>{$application['micr_code']}</td></tr>
<tr><th>IFSC Code</th><td>{$application['ifsc_code']}</td></tr>
<tr><th>Sex</th><td>{$application['sex']}</td></tr>
<tr><th>UMIS No</th><td>{$application['umis_no']}</td></tr>
<tr><th>Aadhar Number</th><td>{$application['aadhaar_no']}</td></tr>
<tr><th>Data Of Birth</th><td>{$application['date_of_birth']}</td></tr>
<tr><th>Community</th><td>{$application['community']}</td></tr>
<tr><th>Sub Caste</th><td>{$application['sub_caste']}</td></tr>
<tr><th>Date Of Joining</th><td>{$application['date_of_joining']}</td></tr>
<tr><th>Student Mobile No</th><td>{$application['student_mobile']}</td></tr>
<tr><th>Parent Mobile No</th><td>{$application['parent_mobile']}</td></tr>
<tr><th>Student Email</th><td>{$application['student_email']}</td></tr>
<tr><th>Received Other Scholarship</th><td>{$application['received_other_scholarship']}</td></tr>
<tr><th>Scholarship Name</th><td>{$application['scholarship_name']}</td></tr>
<tr><th>Hosteller</th><td>{$application['hosteller']}</td></tr>
<tr><th>Application Status</th><td><b style='color:green;'>Submitted</b></td></tr>
</table>

<p class='footer'>Thank you for applying. Please keep this acknowledgment for reference.</p>
";

// Write content to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output PDF for download
$pdf->Output('Acknowledgement.pdf', 'D');
?>
