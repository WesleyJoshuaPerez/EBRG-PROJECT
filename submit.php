<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ebrgy";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

// Helper function for file upload
function uploadFile($file, $target_dir) {
    if (!isset($file['name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'File upload error.'];
    }

    $target_file = $target_dir . basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        return ['success' => true, 'path' => $target_file, 'name' => $file['name']];
    }

    return ['success' => false, 'message' => 'Failed to upload file.'];
}

// Process the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Common form data
    $first_name = $_POST['first_name'] ?? '';
    $middle_name = $_POST['middle_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $age = $_POST['age'] ?? null;
    $apply_myself = $_POST['apply_myself'] ?? null;

    // Validate required fields
    if (empty($first_name) || empty($last_name)) {
        echo json_encode(['success' => false, 'message' => 'First Name and Last Name are required.']);
        exit;
    }

    // Handle file uploads
    $id_pic_result = uploadFile($_FILES['id_pic'], 'uploads/');
    if (!$id_pic_result['success']) {
        echo json_encode($id_pic_result);
        exit;
    }
    $id_pic = $id_pic_result['name'];

    // Determine the type of certificate and perform the appropriate query
    if (isset($_POST['assistance_type']) && isset($age)) {
        // Indigency Certificate
        $assistance_type = $_POST['assistance_type'];
        $sql = $conn->prepare("INSERT INTO indigency_cert (first_name, middle_name, last_name, age, id_pic, assistance_type, apply_myself) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("sssisss", $first_name, $middle_name, $last_name, $age, $id_pic, $assistance_type, $apply_myself);
    } elseif (isset($_POST['yrs_of_occupancy']) && isset($_POST['address'])) {
        // Residency Certificate
        $yrs_of_occupancy = $_POST['yrs_of_occupancy'];
        $address = $_POST['address'];
        $sql = $conn->prepare("INSERT INTO residency_cert (first_name, middle_name, last_name, yrs_occupancy, address, id_pic, apply_myself) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("sssisss", $first_name, $middle_name, $last_name, $yrs_of_occupancy, $address, $id_pic, $apply_myself);
    } elseif (isset($_POST['employer']) && isset($_POST['absence_date']) && isset($_POST['duration']) && isset($_POST['reason'])) {
        // Job Absence Certificate
        $employer = $_POST['employer'];
        $absence_date = $_POST['absence_date'];
        $duration = $_POST['duration'];
        $reason = $_POST['reason'];
        $sql = $conn->prepare("INSERT INTO jobabsence_cert (first_name, middle_name, last_name, id_pic, employer, absence_date, duration, reason, apply_myself) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("sssisssss", $first_name, $middle_name, $last_name, $id_pic, $employer, $absence_date, $duration, $reason, $apply_myself);
    } elseif (isset($_POST['employer'])) {
        // First-Time Job Seeker Certificate
        $employer = $_POST['employer'];
        $sql = $conn->prepare("INSERT INTO jobseek_cert (first_name, middle_name, last_name, id_pic, employer, apply_myself) VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssss", $first_name, $middle_name, $last_name, $id_pic, $employer, $apply_myself);
    } elseif (isset($_POST['years_of_separation']) && isset($_POST['num_children']) && isset($_POST['source_income']) && isset($_POST['monthly_income'])) {
        // Solo Parent Certificate
        $years_of_separation = $_POST['years_of_separation'];
        $num_children = $_POST['num_children'];
        $source_income = $_POST['source_income'];
        $monthly_income = $_POST['monthly_income'];
        $sql = $conn->prepare("INSERT INTO soloparent_cert (first_name, middle_name, last_name, id_pic, years_of_separation, num_children, monthly_income, source_income, apply_myself) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssissss", $first_name, $middle_name, $last_name, $id_pic, $years_of_separation, $num_children, $monthly_income, $source_income, $apply_myself);
    } elseif (isset($_POST['yrs_occupancy'])) {
        // Barangay Clearance Certificate
        $yrs_occupancy = $_POST['yrs_occupancy'];
        $sql = $conn->prepare("INSERT INTO brgyclearance_cert (first_name, middle_name, last_name, age, id_pic, yrs_occupancy, apply_myself) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("sssisss", $first_name, $middle_name, $last_name, $age, $id_pic, $yrs_occupancy, $apply_myself);
    } else {
        echo json_encode(['success' => false, 'message' => 'No matching condition found for the provided data.']);
        exit;
    }

    // Execute the query
    if (isset($sql) && $sql->execute()) {
        echo json_encode(['success' => true, 'message' => 'Record added successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error inserting record: ' . $conn->error]);
    }

    $sql->close();
}

$conn->close();
?>
