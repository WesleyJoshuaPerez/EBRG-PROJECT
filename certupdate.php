<?php
// Database connection and data retrieval logic
function getCertUpdates($username) {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'ebrgy';
    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $tables = [
        'indigency_cert' => 'Certificate of Indigency',
        'residency_cert' => 'Certificate of Residency',
        'jobabsence_cert' => 'Certificate of Job Absence',
        'jobseek_cert' => 'Certificate of Job Seeking',
        'soloparent_cert' => 'Certificate of Solo Parenting',
        'brgyclearance_cert' => 'Barangay Clearance',
        'fencingclearance_cert' => 'Fencing Clearance',
        'blgclearance_cert' => 'Building Clearance',
        'order_payment' => 'Order of Payment',
        'electricity_clearance' => 'Electricity Installation Clearance'
    ];

    $updates = ''; // Variable to store all updates

    foreach ($tables as $table => $certificate_name) {
        // Include current_status in the SELECT query
        $sql = "SELECT pickup_date, remarks, current_status FROM $table WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($pickupdate, $remarks, $current_status);

        while ($stmt->fetch()) {
            // Check the current status and adjust the logic accordingly
            if ($current_status == 'accepted') {
                // If accepted, show the update
                $updates .= "<div class='certupdatecont'>";
                $updates .= "<img src='logo/bell.png' alt='Bell Icon' class='bell-icon'>";
                $updates .= "<p>Good day, $username! Your <strong>$certificate_name</strong> is ready to pick up at the Barangay Hall on: $pickupdate.<br>Remarks: $remarks</p>";
                $updates .= "</div>";  // Closing certupdatecont div
            } elseif ($current_status == 'rejected') {
                // If rejected, show a different message
                $updates .= "<div class='certupdatecont'>";
                $updates .= "<img src='logo/bell.png' alt='Bell Icon' class='bell-icon'>";
                $updates .= "<p>Sorry, $username! Your application for the <strong>$certificate_name</strong> has been <strong>rejected</strong>.<br>Remarks: $remarks</p>";
                $updates .= "</div>";  // Closing certupdatecont div
            }
        }

        $stmt->close();
    }

    $conn->close();

    return $updates ?: "<p>No updates available for you.</p>";
}
?>
