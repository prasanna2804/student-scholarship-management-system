<?php
session_start();
include('../db.php'); // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = strtolower(trim($_POST['username']));  // 👈 optional: force lowercase
    $password = trim($_POST['password']);

    // Prepare SQL statement
    $query = "SELECT * FROM admin WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username); // "s" means string
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Successful login
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            $_SESSION['admin_id'] = $row['id'];  // store admin id
            header("Location: admin_panel.php");
            exit();
        } else {
            echo "<script>alert('Invalid Password');</script>";
        }
    } else {
        echo "<script>alert('Admin not found');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../lra.css">
</head>
<body>
    <div class="container">
        <div>
            <div class="col-md-4">
                <h3 class="text-center" style="font-size:30px">Admin Login</h3>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter Your Username" required>
                    </div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Your Password" required>

                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
s