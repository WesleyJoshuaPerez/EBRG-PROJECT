<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ebrgy";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emoji = $_POST['emoji'];
    $comment = $_POST['comment'] ?? '';

    // Validate emoji input
    if (empty($emoji)) {
        echo "Error: Emoji is required!";
        exit;
    }

    // Insert feedback into the database
    $stmt = $conn->prepare("INSERT INTO user_feedback (emoji, comment) VALUES (?, ?)");
    $stmt->bind_param("ss", $emoji, $comment);

    if ($stmt->execute()) {
        echo "Feedback submitted successfully!";
        header("Location: index.php?status=success");
    } else {
        echo "Error: " . $stmt->error;
        header("Location: index.php?status=error");
    }

    $stmt->close();
    $conn->close();
}
?>
