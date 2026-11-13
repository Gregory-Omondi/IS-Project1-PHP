<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

$stmt = $pdo->prepare(
    "SELECT * FROM feedback WHERE username = ? ORDER BY id DESC"
);
$stmt->execute([$_SESSION["username"]]);
$feedback = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Welcome, <?= htmlspecialchars($_SESSION["username"]) ?>!</h1>

<p>You have successfully logged in.</p>

<a href="feedback.php">Submit Feedback</a> |
<a href="logout.php">Logout</a>

<h2>Your Feedback</h2>

<?php foreach ($feedback as $item): ?>
<div class="feedback">
<strong><?= htmlspecialchars($item["subject"]) ?></strong>
<p><?= nl2br(htmlspecialchars($item["message"])) ?></p>
</div>
<?php endforeach; ?>

</div>
</body>
</html>
