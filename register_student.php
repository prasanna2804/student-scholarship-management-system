<?php
include 'db.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password
    $phone = trim($_POST['phone']);

    // Check if email already exists
    $checkEmail = "SELECT email FROM students WHERE email=?";
    $stmt = $conn->prepare($checkEmail);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "Email already registered!";
    } else {
        // Insert into database
        $sql = "INSERT INTO students (name, email, password, phone) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $password, $phone);
        
        if ($stmt->execute()) {
            echo "Registration successful! <a href='login_student.html'>Login here</a>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>
