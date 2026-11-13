<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Student Feedback</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Student Feedback Form</h1>

<form method="POST" action="submit_feedback.php">
<input type="text" name="subject" placeholder="Subject" required>
<textarea name="message" placeholder="Your feedback" required></textarea>
<button type="submit">Submit Feedback</button>
</form>

<a href="dashboard.php">Back to Dashboard</a>
</div>
</body>
</html>
