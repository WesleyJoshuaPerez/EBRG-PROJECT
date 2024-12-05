<?php
require 'connectdb.php'; // Include the database connection file

// Check if 'id', 'type', 'pickup_date', and 'remarks' are passed via POST
if (isset($_POST['type']) && isset($_POST['id']) && isset($_POST['pickup_date']) && isset($_POST['remarks'])) {
    $type = $_POST['type'];  // Type of certificate (e.g., 'indigency_cert')
    $id = intval($_POST['id']);  // Ensure ID is an integer
    $pickupDate = $_POST['pickup_date']; // Pickup date from the request
    $remarks = $_POST['remarks']; // Notification text from the request

    // Dynamically set the table and column names based on the 'type'
    $updateQuery = '';
    $idColumn = '';

    // Assign correct table and ID column based on certificate type
    switch ($type) {
        case 'indigency_cert':
            $updateQuery = "UPDATE indigency_cert SET current_status = 'accepted', pickup_date = ?, remarks = ? WHERE indigency_id = ?";
            $idColumn = 'indigency_id';
            break;
        case 'residency_cert':
            $updateQuery = "UPDATE residency_cert SET current_status = 'accepted', pickup_date = ?, remarks = ? WHERE residency_id = ?";
            $idColumn = 'residency_id';
            break;
        case 'jobabsence_cert':
            $updateQuery = "UPDATE jobabsence_cert SET current_status = 'accepted', pickup_date = ?, remarks = ? WHERE jobabsence_id = ?";
            $idColumn = 'jobabsence_id';
            break;
        case 'jobseek_cert':
            $updateQuery = "UPDATE jobseek_cert SET current_status = 'accepted', pickup_date = ?, remarks = ? WHERE jobseek_id = ?";
            $idColumn = 'jobseek_id';
            break;
        case 'soloparent_cert':
            $updateQuery = "UPDATE soloparent_cert SET current_status = 'accepted', pickup_date = ?, remarks = ? WHERE soloparent_id = ?";
            $idColumn = 'soloparent_id';
            break;

        case 'brgyclearance_cert':
            $updateQuery = "UPDATE brgyclearance_cert SET current_status = 'accepted', pickup_date = ?, remarks = ? WHERE brgyclearance_id = ?";
            $idColumn = 'brgyclearance_id';
            break;
        case 'fencingclearance_cert':
            $updateQuery = "UPDATE fencingclearance_cert SET current_status = 'accepted', pickup_date = ?, remarks = ? WHERE fencingclearance_id = ?";
            $idColumn = 'fencingclearance_id';
            break;
        case 'blgclearance_cert':
            $updateQuery = "UPDATE blgclearance_cert SET current_status = 'accepted', pickup_date = ?, remarks = ? WHERE blgclearance_id = ?";
            $idColumn = 'blgclearance_id';
            break;
        case 'order_payment':
            $updateQuery = "UPDATE order_payment SET current_status = 'accepted', pickup_date = ?, remarks = ? WHERE orderpayment_id = ?";
            $idColumn = 'orderpayment_id';
            break;
        case 'electricity_clearance':
            $updateQuery = "UPDATE electricity_clearance SET current_status = 'accepted', pickup_date = ?, remarks = ? WHERE electricityclearance_id = ?";
            $idColumn = 'electricityclearance_id';
            break;
            case 'daycare_shortlisting':
            $updateQuery = "UPDATE daycare_shortlisting SET current_status = 'accepted', pickup_date = ?, remarks = ? WHERE daycareshortlisting_id = ?";
            $idColumn = 'electricityclearance_id';
            break;
        default:
            // If type is invalid
            echo json_encode(['success' => false, 'message' => 'Invalid certificate type.']);
            exit;
    }

    // Prepare and execute the update query to change the certificate status, pickup_date, and remarks
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssi", $pickupDate, $remarks, $id);  // Bind pickup_date, remarks, and ID to the query

    if ($stmt->execute()) {
        // Success response
        echo json_encode(['success' => true, 'message' => 'Certificate accepted, pickup details, and remarks updated successfully.']);
    } else {
        // Failure response
        echo json_encode(['success' => false, 'message' => 'Failed to update certificate status, pickup details, or remarks.']);
    }

    // Close the statement
    $stmt->close();
} else {
    // If 'type', 'id', 'pickup_date', or 'remarks' is missing from POST request
    echo json_encode(['success' => false, 'message' => 'Missing required data.']);
}

// Close the database connection
$conn->close();
?>
