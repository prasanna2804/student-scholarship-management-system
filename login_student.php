<?php
include 'db.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if student exists
    $sql = "SELECT id, password FROM students WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['student_id'] = $id;
            $_SESSION['student_email'] = $email;
            header("Location: dashboard_student.php");
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No account found with this email!";
    }

    $stmt->close();
    $conn->close();
}
?>
