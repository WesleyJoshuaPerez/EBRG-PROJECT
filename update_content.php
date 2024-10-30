<?php
header('Content-Type: application/json'); // Ensure JSON response header

include 'connectdb.php';

$response = ['success' => false, 'message' => 'Invalid request'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Log the received POST data (temporary debugging)
    error_log("Received POST data: " . json_encode($_POST)); // Check logs for this

    if (isset($_POST['id'], $_POST['type'], $_POST['title'], $_POST['captions'])) {
        $id = $_POST['id'];
        $type = $_POST['type'];
        $title = $_POST['title'];
        $captions = $_POST['captions'];

        if ($type === 'announcement') {
            $stmt = $conn->prepare("UPDATE brgy_announcement SET announcement_title = ?, announcement_content = ? WHERE announcement_id = ?");
        } elseif ($type === 'event') {
            $stmt = $conn->prepare("UPDATE brgy_event SET brgyevent_title = ?, bgry_content = ? WHERE brgyevent_id = ?");
        } else {
            $response['message'] = 'Invalid update type received: ' . $type;
            echo json_encode($response); // Output with debugging message
            exit;
        }

        if (isset($stmt)) {
            $stmt->bind_param("ssi", $title, $captions, $id);
            if ($stmt->execute()) {
                $response = ['success' => true, 'message' => 'Content updated successfully'];
            } else {
                $response['message'] = 'Failed to update the content.';
            }
            $stmt->close();
        }
    }
}

$conn->close();
echo json_encode($response); // Send JSON response
?>
