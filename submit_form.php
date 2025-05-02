<?php
include 'db.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form fields
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

    // Step 1: Insert into applications table
    $sql = "INSERT INTO applications (
        roll_no, student_online_id, college, course, year, student_name, father_guardian_name,
        occupation, address, bank_account_no, bank_name, branch_name, micr_code, ifsc_code, sex,
        umis_no, aadhaar_no, date_of_birth, community, sub_caste, date_of_joining,
        student_mobile, parent_mobile, student_email, received_other_scholarship,
        scholarship_name, hosteller
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssssssssssssss",
        $roll_no, $student_online_id, $college, $course, $year, $student_name, $father_guardian_name,
        $occupation, $address, $bank_account_no, $bank_name, $branch_name, $micr_code, $ifsc_code,
        $sex, $umis_no, $aadhaar_no, $date_of_birth, $community, $sub_caste, $date_of_joining,
        $student_mobile, $parent_mobile, $student_email, $received_other_scholarship,
        $scholarship_name, $hosteller
    );

    if ($stmt->execute()) {
        $student_id = $stmt->insert_id;  // Get inserted student ID

        // Step 2: Handle file uploads and insert into documents
        $uploadErrors = [];
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']; // Add more MIME types as needed
        
        foreach ($_FILES['documents']['tmp_name'] as $index => $tmpName) {
            $file_name = $_FILES['documents']['name'][$index];
            $document_type = $_POST['document_type'][$index];
            $file_tmp = $_FILES['documents']['tmp_name'][$index];
            $file_size = $_FILES['documents']['size'][$index];
            $file_type = $_FILES['documents']['type'][$index];

            // Validate file type
            if (!in_array($file_type, $allowedTypes)) {
                $uploadErrors[] = "Invalid file type for document: $file_name";
                continue;
            }

            // Check for file size (limit to 10MB in this case)
            if ($file_size > 10485760) {
                $uploadErrors[] = "File size too large for document: $file_name. Max allowed size is 10MB.";
                continue;
            }

            // Sanitize file name and avoid overwriting
            $safe_file_name = time() . "_" . basename($file_name);  // Prefix with timestamp to avoid overwrite
            $target_dir = "uploads/";
            $file_path = $target_dir . $safe_file_name;

            // Move uploaded file
            if (move_uploaded_file($file_tmp, $file_path)) {
                // Insert into documents table
                $doc_stmt = $conn->prepare("INSERT INTO documents (student_id, document_type, file_path) VALUES (?, ?, ?)");
                $doc_stmt->bind_param("iss", $student_id, $document_type, $file_path);
                $doc_stmt->execute();
            } else {
                $uploadErrors[] = "Failed to upload document: $file_name";
            }
        }

        if (count($uploadErrors) > 0) {
            foreach ($uploadErrors as $error) {
                echo "<p>$error</p>";
            }
        } else {
            echo "Application submitted successfully!";
        }

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
