<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ebrgy";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Debug uploaded files
echo "<pre>";
print_r($_FILES);
echo "</pre>";

if (
    isset($_POST['student_first_name'], $_POST['student_middle_name'], $_POST['student_last_name'], $_POST['kinder_level'], 
          $_POST['guardian_first_name'], $_POST['guardian_middle_name'], $_POST['guardian_last_name'], $_POST['guardian_age'], $_POST['guardian_contact_num']) &&
    isset($_FILES['health_record'], $_FILES['birth_cert'], $_FILES['guardian_id']) &&
    $_FILES['health_record']['error'] === UPLOAD_ERR_OK &&
    $_FILES['birth_cert']['error'] === UPLOAD_ERR_OK &&
    $_FILES['guardian_id']['error'] === UPLOAD_ERR_OK
) {
    // Student's information
    $student_fname = $_POST['student_first_name'];
    $student_mname = $_POST['student_middle_name'];
    $student_lname = $_POST['student_last_name'];
    $student_level = $_POST['kinder_level'];

    // Guardian's information
    $guardian_fname = $_POST['guardian_first_name'];
    $guardian_mname = $_POST['guardian_middle_name'];
    $guardian_lname = $_POST['guardian_last_name'];
    $guardian_age = intval($_POST['guardian_age']); // Convert to integer
    $guardian_contactnum = $_POST['guardian_contact_num'];

    // Handle file uploads
    $target_dir = "uploads/";

    $student_healthrecord = $_FILES['health_record']['name'];
    $healthrecord_path = $target_dir . basename($student_healthrecord);
    if (!move_uploaded_file($_FILES['health_record']['tmp_name'], $healthrecord_path)) {
        echo "Failed to upload health record.";
        exit;
    }

    $student_birthcert = $_FILES['birth_cert']['name'];
    $birthcert_path = $target_dir . basename($student_birthcert);
    if (!move_uploaded_file($_FILES['birth_cert']['tmp_name'], $birthcert_path)) {
        echo "Failed to upload birth certificate.";
        exit;
    }

    $guardian_id = $_FILES['guardian_id']['name'];
    $guardian_id_path = $target_dir . basename($guardian_id);
    if (!move_uploaded_file($_FILES['guardian_id']['tmp_name'], $guardian_id_path)) {
        echo "Failed to upload guardian ID.";
        exit;
    }

    // Construct SQL query
    $sql = "INSERT INTO daycare_shortlisting (
                student_fname, student_mname, student_lname, student_healthrecord, 
                student_birthcert, student_level, guardian_fname, guardian_mname, 
                guardian_lname, guardian_age, guardian_id, guardian_contactnum
            ) VALUES (
                '$student_fname', '$student_mname', '$student_lname', '$student_healthrecord', 
                '$student_birthcert', '$student_level', '$guardian_fname', '$guardian_mname', 
                '$guardian_lname', $guardian_age, '$guardian_id', '$guardian_contactnum'
            )";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error executing query: " . $conn->error;
    }
} else {
    echo "One or more files are missing or have upload errors.";
    exit;
}

$conn->close();
?>
