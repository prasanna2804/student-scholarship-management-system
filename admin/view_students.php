<?php
include '../db.php'; // Database connection

// Fetch student applications and their documents
$query = "SELECT a.*, d.document_id AS doc_id, d.document_type, d.file_path, d.uploaded_at  
          FROM applications a 
          LEFT JOIN documents d ON a.student_id = d.student_id  
          ORDER BY a.student_id";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Students & Verify Documents</title>

  <style>
        /* Set background color */
body {
    background-color: #87CEFA; /* Light Sky Blue */
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
}

/* Center the title */
h2 {
    text-align: center;
    color: #333;
}

/* Style the table */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    overflow: hidden;
}

/* Table headers */
th {
    background: #4682B4; /* Steel Blue */
    color: white;
    padding: 12px;
    text-align: left;
}

/* Table rows */
td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

/* Alternating row colors */
tr:nth-child(even) {
    background: #f2f2f2;
}

/* Hover effect */
tr:hover {
    background: #dbeeff;
    transition: 0.3s;
}

/* Links inside the table */
a {
    text-decoration: none;
    color: #007BFF;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

/* Button styling */
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

<h2>Student Applications - View Student Full Details</h2>

<table border="1">
    <tr>
        <th>Student ID</th>
        <th>Roll No</th>
        <th>Name</th>
        <th>Course</th>
        <th>Year</th>
        <th>Community</th>
        <th>Scholarship</th>
        <th>Application Status</th>
        <th>Documents</th>
         <th>view details</th>
    </tr>

   <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['student_id'] ?></td>
        <td><?= $row['roll_no'] ?></td>
        <td><?= $row['student_name'] ?></td>
        <td><?= $row['course'] ?></td>
        <td><?= $row['year'] ?></td>
        <td><?= $row['community'] ?></td>
        <td><?= $row['scholarship_name'] ?></td>
        <td><?= $row['application_status'] ?></td>
      
        <td>
            <?php if ($row['file_path']) { ?>
                <a href="<?= $row['file_path'] ?>" target="_blank"><?= $row['document_type'] ?></a>
            <?php } else { echo "No Document"; } ?>
        </td>
  <td>
    <a href="student_full_details.php?student_id=<?php echo $row['student_id'];?>">View Full Details</a>
</td>
    </tr>
    <?php } ?>
</table>
</body>
</html>

