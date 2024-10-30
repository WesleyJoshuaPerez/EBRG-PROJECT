<?php
require 'connectdb.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];

    // Get the ID from POST data
    $id = $_POST['id'];

    // Fetch the existing image file name from the database
    $query = "SELECT announcement_img FROM brgy_announcement WHERE announcement_id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Check if the existing image file exists
    if ($row) {
        $oldFileName = $row['announcement_img'];
        $oldFilePath = './uploads/' . $oldFileName;

        // Delete the old file if it exists
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath); // Delete the old image
        }
    }

    // Check if a new file was uploaded without errors
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Allowed file extensions
        $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif','jfif'];

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Set the destination path
            $uploadFileDir = './uploads/';
            $newFileName = time() . '_' . $fileName; // Prepend timestamp to ensure uniqueness
            $dest_path = $uploadFileDir . $newFileName;

            // Move the file to the destination
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Update the database with the new image path
                $sql = "UPDATE brgy_announcement SET announcement_img = '$newFileName' WHERE announcement_id = $id";
                mysqli_query($conn, $sql);

                $response['success'] = true;
                $response['message'] = 'File is successfully uploaded.';
                $response['fileName'] = $newFileName; // Return the new file name for updating the display
            } else {
                $response['message'] = 'Sorry, your file was not uploaded.';
            }
        } else {
            $response['message'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        }
    } else {
        $response['message'] = 'No file uploaded or there was an upload error.';
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    echo 'Invalid request method.';
}
?>
