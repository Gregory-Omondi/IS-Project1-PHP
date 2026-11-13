<?php
require 'db.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($username === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)
        || strlen($password) < 6) {
        $message = "Please enter valid details. Password must be at least 6 characters.";
    } else {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare(
                "INSERT INTO users (username,email,password) VALUES (?,?,?)"
            );

            $stmt->execute([$username,$email,$hash]);

            $message = "Registration successful!";
        } catch (PDOException $e) {
            $message = "Registration failed. Username or email may already exist.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Registration</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Student Registration</h1>
<p>Create your student account</p>

<p><?= htmlspecialchars($message) ?></p>

<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" minlength="6" required>
<button type="submit">Register</button>
</form>

<p>Already registered? <a href="login.php">Login</a></p>
</div>
</body>
</html>
