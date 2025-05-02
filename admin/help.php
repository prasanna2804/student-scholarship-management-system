<?php
include('../db.php'); // Database connection
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

// --- Add New FAQ ---
if (isset($_POST['add_faq'])) {
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $answer = mysqli_real_escape_string($conn, $_POST['answer']);
    $insert_query = "INSERT INTO faqs (question, answer) VALUES ('$question', '$answer')";
    mysqli_query($conn, $insert_query);
    header('Location: help.php');
    exit();
}

// --- Update Existing FAQ ---
if (isset($_POST['update_faq'])) {
    $faq_id = intval($_POST['faq_id']);
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $answer = mysqli_real_escape_string($conn, $_POST['answer']);
    $update_query = "UPDATE faqs SET question='$question', answer='$answer' WHERE id=$faq_id";
    mysqli_query($conn, $update_query);
    header('Location: help.php');
    exit();
}

// --- Delete FAQ ---
if (isset($_GET['delete'])) {
    $faq_id = intval($_GET['delete']);
    $delete_query = "DELETE FROM faqs WHERE id=$faq_id";
    mysqli_query($conn, $delete_query);
    header('Location: help.php');
    exit();
}

// --- Fetch FAQ Data ---
$faqs = mysqli_query($conn, "SELECT * FROM faqs ORDER BY created_at DESC");

// --- Fetch Single FAQ for Editing ---
$edit_mode = false;
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $edit_id = intval($_GET['edit']);
    $edit_query = mysqli_query($conn, "SELECT * FROM faqs WHERE id=$edit_id");
    $edit_faq = mysqli_fetch_assoc($edit_query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Help and Support - Admin Panel</title>
    <link rel="stylesheet" href="styles.css"> <!-- Your CSS file -->
   <style>
 
/* Basic Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Style */
body {
    font-family: 'Roboto', sans-serif;
    background: linear-gradient(to right, #d0e7ff, #f0f8ff);
    color: #003366; /* Changed to strong blue */
    min-height: 100vh;
    padding: 40px;
}

/* Container */
.container {
    max-width: 1000px;
    margin: auto;
    background: #ffffff;
    border-radius: 15px;
    padding: 40px;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
}

/* Page Title */
h1 {
    text-align: center;
    font-size: 36px;
    color: #0047ab; /* Darker blue */
    margin-bottom: 30px;
    font-weight: 700;
}

/* FAQ Box */
.faq-item {
    background: #f0f6ff;
    border-left: 5px solid #3399ff;
    margin-bottom: 20px;
    padding: 25px 30px;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.faq-item:hover {
    background: #e6f0ff;
    transform: translateY(-3px);
    box-shadow: 0px 8px 20px rgba(0, 82, 204, 0.2);
}

/* Question */
.question {
    font-size: 22px;
    color: #0066cc; /* Brighter blue */
    font-weight: 600;
    margin-bottom: 10px;
}

/* Answer */
.answer {
    font-size: 16px;
    color: #0059b3; /* Medium blue */
    line-height: 1.8;
}

/* Form */
form {
    margin-top: 50px;
}

form input[type="text"],
form textarea {
    width: 100%;
    padding: 15px;
    margin-bottom: 20px;
    border: 2px solid #cce0ff;
    border-radius: 10px;
    font-size: 16px;
    color: #003366;
    transition: border-color 0.3s;
}

form input[type="text"]:focus,
form textarea:focus {
    border-color: #3399ff;
    outline: none;
}

/* Regular Buttons (Edit, Delete) */
.btn {
    background-color: #3399ff;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    margin-right: 8px;
    transition: background 0.3s ease;
    text-decoration: none;
}

.btn:hover {
    background-color: #267acc;
}

/* Add FAQ Button - Special Style */
.add-faq-btn {
    display: inline-block;
    background: linear-gradient(to right, #3399ff, #0052cc);
    color: #fff;
    padding: 14px 28px;
    border-radius: 50px;
    font-size: 18px;
    font-weight: bold;
    border: none;
    text-align: center;
    cursor: pointer;
    transition: background 0.4s;
    margin-bottom: 30px;
}

.add-faq-btn:hover {
    background: linear-gradient(to right, #0052cc, #003d99);
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding: 20px;
    }

    h1 {
        font-size: 28px;
    }

    .faq-item {
        padding: 20px;
    }
}

</style>

</head>
<body>

<h1>Help and Support</h1>

<!-- Add or Edit FAQ Form -->
<section>
    <?php if ($edit_mode): ?>
        <h2>Edit FAQ</h2>
        <form action="help.php" method="POST">
            <input type="hidden" name="faq_id" value="<?= $edit_faq['id'] ?>">
            <label>Question:</label>
            <input type="text" name="question" value="<?= htmlspecialchars($edit_faq['question']) ?>" required>
            
            <label>Answer:</label>
            <textarea name="answer" required><?= htmlspecialchars($edit_faq['answer']) ?></textarea>

            <button type="submit" name="update_faq">Update FAQ</button>
            <a href="help.php" style="margin-left: 10px;">Cancel</a>
        </form>
    <?php else: ?>
        <h2>Add New FAQ</h2>
        <form action="help.php" method="POST">
            <label>Question:</label>
            <input type="text" name="question" required>
            
            <label>Answer:</label>
            <textarea name="answer" required></textarea>

            <button type="submit" name="add_faq" class="add-faq-btn">Add FAQ</button>
        </form>
    <?php endif; ?>
</section>

<!-- List of Existing FAQs -->
<section>
    <h2>Existing FAQs</h2>
    <table>
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($faq = mysqli_fetch_assoc($faqs)): ?>
                <tr>
                    <td><?= htmlspecialchars($faq['question']) ?></td>
                    <td><?= htmlspecialchars($faq['answer']) ?></td>
                    <td class="action-links">
                        <a href="help.php?edit=<?= $faq['id'] ?>">Edit</a>
                        <a href="help.php?delete=<?= $faq['id'] ?>" onclick="return confirm('Are you sure you want to delete this FAQ?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>

</body>
</html>
