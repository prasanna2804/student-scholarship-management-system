<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['document_id'])) {
    $document_id = $_POST['document_id'];

    // Update document status to Verified
    $query = "UPDATE documents SET document_status = 'Verified' WHERE id = '$document_id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Document Verified Successfully!'); window.history.back();</script>";
    } else {
        echo "<script>alert('Verification Failed!'); window.history.back();</script>";
    }
} else {
    echo "Invalid Request!";
}
?>
