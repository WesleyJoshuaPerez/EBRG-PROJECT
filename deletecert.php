<?php
require 'connectdb.php'; // Include the database connection file

// Check if 'id' and 'type' are passed via POST
if (isset($_POST['type']) && isset($_POST['id'])) {
    $type = $_POST['type'];  // Type of certificate (e.g., 'indigency_cert')
    $id = intval($_POST['id']);  // Ensure ID is an integer

    // Dynamically set the table and column names based on the 'type'
    $updateQuery = '';
    $idColumn = '';

    // Assign correct table and ID column based on certificate type
    switch ($type) {
        case 'indigency_cert':
            $updateQuery = "UPDATE indigency_cert SET current_status = 'rejected' WHERE indigency_id = ?";
            $idColumn = 'indigency_id';
            break;
        case 'residency_cert':
            $updateQuery = "UPDATE residency_cert SET current_status = 'rejected' WHERE residency_id = ?";
            $idColumn = 'residency_id';
            break;
        case 'jobabsence_cert':
            $updateQuery = "UPDATE jobabsence_cert SET current_status = 'rejected' WHERE jobabsence_id = ?";
            $idColumn = 'jobabsence_id';
            break;
        case 'jobseek_cert':
            $updateQuery = "UPDATE jobseek_cert SET current_status = 'rejected' WHERE jobseek_id = ?";
            $idColumn = 'jobseek_id';
            break;
        case 'soloparent_cert':
            $updateQuery = "UPDATE soloparent_cert SET current_status = 'rejected' WHERE soloparent_id = ?";
            $idColumn = 'soloparent_id';
            break;

        case 'brgyclearance_cert':
            $updateQuery = "UPDATE brgyclearance_cert SET current_status = 'rejected' WHERE brgyclearance_id = ?";
            $idColumn = 'brgyclearance_id';
            break;
        case 'fencingclearance_cert':
            $updateQuery = "UPDATE fencingclearance_cert SET current_status = 'rejected' WHERE fencingclearance_id = ?";
            $idColumn = 'fencingclearance_id';
            break;
        case 'blgclearance_cert':
            $updateQuery = "UPDATE blgclearance_cert SET current_status = 'rejected' WHERE blgclearance_id = ?";
            $idColumn = 'blgclearance_id';
            break;
        case 'order_payment':
            $updateQuery = "UPDATE order_payment SET current_status = 'rejected' WHERE orderpayment_id = ?";
            $idColumn = 'orderpayment_id';
            break;
        case 'electricity_clearance':
            $updateQuery = "UPDATE electricity_clearance SET current_status = 'rejected' WHERE electricityclearance_id = ?";
            $idColumn = 'electricityclearance_id';
            break;
        default:
            // If type is invalid
            echo json_encode(['success' => false, 'message' => 'Invalid certificate type.']);
            exit;
    }

    // Prepare and execute the update query
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("i", $id);  // Bind the ID to the query

    if ($stmt->execute()) {
        // Success response
        echo json_encode(['success' => true, 'message' => 'Certificate marked as rejected successfully.']);
    } else {
        // Failure response
        echo json_encode(['success' => false, 'message' => 'Failed to update certificate status.']);
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
