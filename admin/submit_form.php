<?php
session_start();
include 'db.php'; // Ensure correct database connection

if (!isset($_SESSION['student_id'])) {
    header("Location: login_student.php");
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
    header("Location: acknowledgement.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roll_no = $_POST['roll_no'];
    $student_online_id = $_POST['student_online_id'];
    $college = $_POST['college'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $student_name = $_POST['student_name'];
    $father_guardian_name = $_POST['father_guardian_name'];
    $occupation = $_POST['occupation'];
    $address = $_POST['address'];
    $bank_account_no = $_POST['bank_account_no'];
    $bank_name = $_POST['bank_name'];
    $branch_name = $_POST['branch_name'];
    $micr_code = $_POST['micr_code'];
    $ifsc_code = $_POST['ifsc_code'];
    $sex = $_POST['sex'];
    $umis_no = $_POST['umis_no'];
    $aadhaar_no = $_POST['aadhaar_no'];
    $date_of_birth = $_POST['date_of_birth'];
    $community = $_POST['community'];
    $sub_caste = $_POST['sub_caste'];
    $date_of_joining = $_POST['date_of_joining'];
    $student_mobile = $_POST['student_mobile'];
    $parent_mobile = $_POST['parent_mobile'];
    $student_email = $_POST['student_email'];
    $received_other_scholarship = $_POST['received_other_scholarship'];
    $scholarship_name = $_POST['scholarship_name'];
    $hosteller = $_POST['hosteller'];

$sql = "INSERT INTO applications (
    roll_no, student_online_id, college, course, year, 
    student_name, father_guardian_name, occupation, address, 
    bank_account_no, bank_name, branch_name, micr_code, ifsc_code, 
    sex, umis_no, aadhaar_no, date_of_birth, community, sub_caste, 
    date_of_joining, student_mobile, parent_mobile, student_email, 
    received_other_scholarship, scholarship_name, hosteller
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


    $stmt = $conn->prepare($sql);
if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param(
    "isssissssssssssssssssssssss", 
    $roll_no, $student_online_id, $college, $course, $year,
    $student_name, $father_guardian_name, $occupation, $address,
    $bank_account_no, $bank_name, $branch_name, $micr_code, $ifsc_code,
    $sex, $umis_no, $aadhaar_no, $date_of_birth, $community, $sub_caste,
    $date_of_joining, $student_mobile, $parent_mobile, $student_email,
    $received_other_scholarship, $scholarship_name, $hosteller
);


    if ($stmt->execute()) {
        $application_id = $stmt->insert_id; // Get last inserted ID

        // ✅ File Upload Handling
        if (isset($_FILES['documents'])) {
            $uploadDir = 'uploads/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            foreach ($_FILES['documents']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['documents']['error'][$key] === UPLOAD_ERR_OK) {
                    $documentType = $_POST['document_types'][$key]; // Get document type dynamically
                    $fileName = basename($_FILES['documents']['name'][$key]);
                    $filePath = $uploadDir . time() . "_" . $fileName; // Unique file name

                    if (move_uploaded_file($tmp_name, $filePath)) {
                        // Insert into documents table
                        $doc_stmt = $conn->prepare("INSERT INTO documents (application_id, document_type, file_path) VALUES (?, ?, ?)");
                        $doc_stmt->bind_param("iss", $application_id, $documentType, $filePath);
                        $doc_stmt->execute();
                        $doc_stmt->close();
                    }
                }
            }
        }

        header("Location: acknowledgement.php");
        exit();
    } else {
        echo "Error executing statement: " . $stmt->error;
    }
}

mysqli_close($conn);
?>
