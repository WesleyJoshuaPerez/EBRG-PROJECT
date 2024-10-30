<?php
require 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['updates'] ?? null; // Type of update (announcement/event)
    $title = $_POST['title'] ?? null;   // Title of the announcement/event
    $captions = $_POST['captions'] ?? null; // Content/captions for the announcement/event
    $image = $_FILES['image'] ?? null; // Uploaded image
    $id = $_POST['id'] ?? null; // Optional ID for updates

    // Function to check for duplicates based on title
    function checkDuplicate($conn, $type, $title) {
        $count = 0; // Initialize $count
        if ($type == 'announcement') {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM brgy_announcement WHERE announcement_title = ?");
        } elseif ($type == 'event') {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM brgy_event WHERE brgyevent_title = ?");
        } else {
            return false; // Invalid type
        }

        $stmt->bind_param("s", $title);
        $stmt->execute();
        $stmt->bind_result($count); // Bind the result to $count
        $stmt->fetch();
        $stmt->close();

        return $count > 0; // Returns true if a duplicate exists
    }

    // Check for duplicates before inserting a new record
    if (!$id && checkDuplicate($conn, $type, $title)) {
        echo json_encode(['success' => false, 'message' => 'This title already exists.']);
        exit;
    }

    // Check if an image is uploaded
    if ($image && $image['error'] == 0) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($image['name']);

        // Move the uploaded file to the designated directory
        if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
            // Prepare SQL statements based on whether we are inserting or updating
            if ($id) { // Update scenario
                if ($type == 'announcement') {
                    $stmt = $conn->prepare("UPDATE brgy_announcement SET announcement_title = ?, announcement_img = ?, announcement_content = ? WHERE announcement_id = ?");
                    $stmt->bind_param("sssi", $title, $image['name'], $captions, $id);
                } elseif ($type == 'event') {
                    $stmt = $conn->prepare("UPDATE brgy_event SET brgyevent_title = ?, brgy_img = ?, bgry_content = ? WHERE brgyevent_id = ?");
                    $stmt->bind_param("sssi", $title, $image['name'], $captions, $id);
                }
            } else { // Insert scenario
                if ($type == 'announcement') {
                    $stmt = $conn->prepare("INSERT INTO brgy_announcement (announcement_title, announcement_img, announcement_content) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $title, $image['name'], $captions);
                } elseif ($type == 'event') {
                    $stmt = $conn->prepare("INSERT INTO brgy_event (brgyevent_title, brgy_img, bgry_content) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $title, $image['name'], $captions);
                }
            }

            // Execute the prepared statement
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to insert/update the database.']);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to upload image.']);
        }
    } else {
        // If no new image is uploaded during update
        if ($id) { // Update scenario without image
            if ($type == 'announcement') {
                $stmt = $conn->prepare("UPDATE brgy_announcement SET announcement_title = ?, announcement_content = ? WHERE announcement_id = ?");
                $stmt->bind_param("ssi", $title, $captions, $id);
            } elseif ($type == 'event') {
                $stmt = $conn->prepare("UPDATE brgy_event SET brgyevent_title = ?, bgry_content = ? WHERE brgyevent_id = ?");
                $stmt->bind_param("ssi", $title, $captions, $id);
            }

            // Execute the prepared statement
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update the database.']);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'No image uploaded.']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$conn->close();
?>
