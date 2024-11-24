<?php
include 'connectdb.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $emoji = $data['emoji'];
    $comment = $data['comment'] ?? null;

    $stmt = $conn->prepare("INSERT INTO emoji_feedback (emoji, comment, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $emoji, $comment);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    $conn->close();
}
?>
