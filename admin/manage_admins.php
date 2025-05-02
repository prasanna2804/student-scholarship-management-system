<?php
// manage_admins.php
include('../db.php'); // Your database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Admins</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>



<div class="content">
    <h2>Manage Admins</h2>
    <a href="add_admin.php" class="btn btn-primary mb-3">+ Add New Admin</a>

    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Admin Username</th>
                <th>password</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $admins = mysqli_query($conn, "SELECT * FROM admin"); 
            while($row = mysqli_fetch_assoc($admins)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['password']}</td>
                        <td>
                            <a href='delete_admin.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
