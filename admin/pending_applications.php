<?php
session_start();
include('../db.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login_admin.php");
    exit();
}

// Approve or Reject applications
if (isset($_POST['approve'])) {
    $id = $_POST['student_id'];
    mysqli_query($conn, "UPDATE applications SET application_status='Approved'  WHERE student_id=$id");
    header("Location: pending_applications.php");
    exit();
}


if (isset($_POST['reject'])) {
    $id = $_POST['student_id'];
    mysqli_query($conn, "UPDATE applications SET application_status='Rejected' WHERE student_id=$id");
    header("Location: pending_applications.php");
    exit();
}

// Fetch student applications
$query = "SELECT * FROM applications WHERE application_status = 'Pending' ORDER BY student_id";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pending Applications</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #87CEFA; /* Light Sky Blue */
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }
        th {
            background: #4682B4;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        tr:hover {
            background: #dbeeff;
            transition: 0.3s;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        button {
            background: #28a745;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Pending Applications</h2>
        <table class="table table-bordered">
            <tr>
                <th>Student Name</th>
                <th>Email</th>
                <th>Scholarship Name</th>
                <th>Application Date</th>
                <th>View Documents</th>
                <th>View Full Application</th>
                <th>Application Status</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['student_name']; ?></td>
                    <td><?php echo $row['student_email']; ?></td>
                    <td><?php echo $row['scholarship_name']; ?></td>   
                    <td><?php echo $row['created_at']; ?></td>
                    
                    <!-- Fetch Documents -->
                    <td>
                        <?php
                        $app_id = $row['student_id'];
                        $doc_query = "SELECT document_type, file_path FROM documents WHERE student_id = $app_id";
                        $doc_result = mysqli_query($conn, $doc_query);
                        if (mysqli_num_rows($doc_result) > 0) {
                            while ($doc = mysqli_fetch_assoc($doc_result)) {
                                echo '<a href="'.$doc['file_path'].'" target="_blank">'.$doc['document_type'].'</a><br>';
                            }
                        } else {
                            echo "No Document";
                        }
                        ?>
                    </td>

                    <td>
                        <a href="student_full_details.php?student_id=<?php echo $row['student_id'];?>">View Full Details</a>
                    </td>

                    <td><?php echo $row['application_status']; ?></td> 

                    <td>
                        <form method="post">
                            <input type="hidden" name="student_id" value="<?php echo $row['student_id']; ?>">
                            <button type="submit" name="approve" class="btn btn-success">Approve</button>
                            <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
