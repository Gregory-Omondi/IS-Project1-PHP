<?php
session_start();
require 'db.php';

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    if ($subject !== "" && $message !== "") {
        $stmt = $pdo->prepare(
            "INSERT INTO feedback (username,subject,message) VALUES (?,?,?)"
        );

        $stmt->execute([
            $_SESSION["username"],
            $subject,
            $message
        ]);

        header("Location: dashboard.php");
        exit;
    }
}

echo "Please enter both subject and message.";
?>
