<?php
require 'connectdb.php';

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];
    $imagePath = ''; // Initialize variable

    if ($type === 'announcement') {
        // Prepare and execute query to get image path
        $getImageQuery = "SELECT announcement_img FROM brgy_announcement WHERE announcement_id = ?";
        $stmt = $conn->prepare($getImageQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($imageName);
        $stmt->fetch();
        $stmt->close();

        // Construct the full image path
        $imagePath = 'uploads/' . $imageName;

        // Prepare and execute delete query for announcement
        $deleteQuery = "DELETE FROM brgy_announcement WHERE announcement_id = ?";
    } elseif ($type === 'event') {
        // Prepare and execute query to get image path for events
        $getImageQuery = "SELECT brgy_img FROM brgy_event WHERE brgyevent_id = ?";
        $stmt = $conn->prepare($getImageQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($imageName);
        $stmt->fetch();
        $stmt->close();

        // Construct the full image path for events
        $imagePath = 'uploads/' . $imageName;

        // Prepare and execute delete query for event
        $deleteQuery = "DELETE FROM brgy_event WHERE brgyevent_id = ?";
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid type.']);
        exit;
    }

    // Delete the image file if it exists
    if (!empty($imagePath) && file_exists($imagePath)) {
        unlink($imagePath); // Remove the file
    }

    // Execute delete query
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No ID or type provided.']);
}

$conn->close();
?>
