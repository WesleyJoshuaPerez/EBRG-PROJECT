<?php
require 'connectdb.php';

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = intval($_GET['id']); // Ensure ID is an integer
    $imagePath = ''; // Initialize variable for image path
    $deleteQuery = ''; // Initialize delete query

    if ($type === 'announcement') {
        // Handle announcement deletion
        $getImageQuery = "SELECT announcement_img FROM brgy_announcement WHERE announcement_id = ?";
        $stmt = $conn->prepare($getImageQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($imageName);
        $stmt->fetch();
        $stmt->close();

        $imagePath = 'uploads/' . $imageName;
        $deleteQuery = "DELETE FROM brgy_announcement WHERE announcement_id = ?";
    } elseif ($type === 'event') {
        // Handle event deletion
        $getImageQuery = "SELECT brgy_img FROM brgy_event WHERE brgyevent_id = ?";
        $stmt = $conn->prepare($getImageQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($imageName);
        $stmt->fetch();
        $stmt->close();

        $imagePath = 'uploads/' . $imageName;
        $deleteQuery = "DELETE FROM brgy_event WHERE brgyevent_id = ?";
    } elseif (in_array($type, ['indigency_cert', 'residency_cert', 'jobabsence_cert', 'jobseek_cert', 'soloparent_cert'])) {
        // Handle services deletion dynamically
        $idColumn = '';
        switch ($type) {
            case 'indigency_cert':
                $idColumn = 'indigency_id';
                break;
            case 'residency_cert':
                $idColumn = 'residency_id';
                break;
            case 'jobabsence_cert':
                $idColumn = 'jobabsence_id';
                break;
            case 'jobseek_cert':
                $idColumn = 'jobseek_id';
                break;
            case 'soloparent_cert':
                $idColumn = 'soloparent_id';
                break;
            default:
                echo json_encode(['success' => false, 'message' => 'Invalid type.']);
                exit;
        }
        $deleteQuery = "DELETE FROM $type WHERE $idColumn = ?";
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid type.']);
        exit;
    }

    // Delete the image file if applicable
    if (!empty($imagePath) && file_exists($imagePath)) {
        unlink($imagePath); // Remove the file
    }

    // Execute the delete query
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
