<?php
// Include the database connection file
include('../db.php');

// Check if the database connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch the FAQ data from the database
$query = "SELECT * FROM faqs ORDER BY id DESC";  // Make sure the table name and column names are correct
$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
    die("Query failed: " . mysqli_error($conn));  // This will display the actual error if the query fails
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions</title>
    <style>
        .faq-container {
            margin: 20px;
            font-family: Arial, sans-serif;
        }
        .faq-question {
            font-size: 18px;
            font-weight: bold;
            color: #3498db;
        }
        .faq-answer {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="faq-container">
        <h1>Frequently Asked Questions</h1>
        <?php
        // Check if there are any FAQs to display
        if (mysqli_num_rows($result) > 0) {
            // Loop through each FAQ and display them
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="faq-item">';
                echo '<div class="faq-question">' . htmlspecialchars($row['question']) . '</div>';
                echo '<div class="faq-answer">' . nl2br(htmlspecialchars($row['answer'])) . '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No FAQs available yet. Please check back later!</p>";
        }
        ?>
    </div>
</body>
</html>
