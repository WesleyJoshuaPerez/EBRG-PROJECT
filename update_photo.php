<?php
require 'connectdb.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];

    // Get the ID and type from POST data
    $id = $_POST['id'];
    $type = $_POST['type'];

    // Determine the table and image field based on the type
    if ($type === 'announcement') {
        $table = 'brgy_announcement';
        $imageField = 'announcement_img';
        $idField = 'announcement_id';
    } elseif ($type === 'event') {
        $table = 'brgy_event';
        $imageField = 'brgy_img';
        $idField = 'brgyevent_id';
    } else {
        $response['message'] = 'Invalid update type.';
        echo json_encode($response);
        exit;
    }

    // Fetch the existing image file name from the database
    $query = "SELECT $imageField FROM $table WHERE $idField = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $oldFileName = $row[$imageField];
        $oldFilePath = './uploads/' . $oldFileName;

        // Delete the old file if it exists
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath); // Delete the old image
        }

        // Check if a new file was uploaded without errors
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Allowed file extensions
            $allowedFileExtensions = ['jpg', 'jpeg', 'png', 'gif', 'jfif'];

            if (in_array($fileExtension, $allowedFileExtensions)) {
                // Set the destination path
                $uploadFileDir = './uploads/';
                $newFileName = time() . '_' . $fileName; // Prepend timestamp to ensure uniqueness
                $dest_path = $uploadFileDir . $newFileName;

                // Move the file to the destination
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    // Update the database with the new image path
                    $updateQuery = "UPDATE $table SET $imageField = '$newFileName' WHERE $idField = $id";
                    if (mysqli_query($conn, $updateQuery)) {
                        $response['success'] = true;
                        $response['message'] = 'File is successfully uploaded.';
                        $response['fileName'] = $newFileName; // Return the new file name for updating the display
                    } else {
                        $response['message'] = 'Database update failed.';
                    }
                } else {
                    $response['message'] = 'File could not be uploaded.';
                }
            } else {
                $response['message'] = 'Only JPG, JPEG, PNG, GIF, and JFIF files are allowed.';
            }
        } else {
            $response['message'] = 'No file uploaded or there was an upload error.';
        }
    } else {
        $response['message'] = ucfirst($type) . ' not found or invalid ID.';
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo 'Invalid request method.';
}
?>
