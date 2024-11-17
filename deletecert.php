<?php
require 'connectdb.php'; // Include the database connection file

// Check if 'id' and 'type' are passed via POST
if (isset($_POST['type']) && isset($_POST['id'])) {
    $type = $_POST['type'];  // Type of certificate (e.g., 'indigency_cert')
    $id = intval($_POST['id']);  // Ensure ID is an integer

    // Dynamically set the table and column names based on the 'type'
    $deleteQuery = '';
    $idColumn = '';

    // Assign correct table and ID column based on certificate type
    switch ($type) {
        case 'indigency_cert':
            $deleteQuery = "DELETE FROM indigency_cert WHERE indigency_id = ?";
            $idColumn = 'indigency_id';
            break;
        case 'residency_cert':
            $deleteQuery = "DELETE FROM residency_cert WHERE residency_id = ?";
            $idColumn = 'residency_id';
            break;
        case 'jobabsence_cert':
            $deleteQuery = "DELETE FROM jobabsence_cert WHERE jobabsence_id = ?";
            $idColumn = 'jobabsence_id';
            break;
        case 'jobseek_cert':
            $deleteQuery = "DELETE FROM jobseek_cert WHERE jobseek_id = ?";
            $idColumn = 'jobseek_id';
            break;
        case 'soloparent_cert':
            $deleteQuery = "DELETE FROM soloparent_cert WHERE soloparent_id = ?";
            $idColumn = 'soloparent_id';
            break;
        default:
            // If type is invalid
            echo json_encode(['success' => false, 'message' => 'Invalid certificate type.']);
            exit;
    }

    // Prepare and execute the delete query
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $id);  // Bind the ID to the query

    if ($stmt->execute()) {
        // Success response
        echo json_encode(['success' => true, 'message' => 'Certificate deleted successfully.']);
    } else {
        // Failure response
        echo json_encode(['success' => false, 'message' => 'Failed to delete certificate.']);
    }

    // Close the statement
    $stmt->close();
} else {
    // If 'type' or 'id' is missing from POST request
    echo json_encode(['success' => false, 'message' => 'No ID or type provided.']);
}

// Close the database connection
$conn->close();
?>
