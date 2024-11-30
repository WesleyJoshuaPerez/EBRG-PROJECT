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

session_start(); // Start session to access session variables

// use to get the current username and store it in the session
$current_username = $_SESSION['username'] ?? ''; // Get the username from session

$first_name = $_POST['first_name'] ?? '';
$middle_name = $_POST['middle_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$apply_myself = isset($_POST['apply_myself']) ? $_POST['apply_myself'] : null;

$target_dir = "uploads/";

// Function to render success or error messages with iframe
function renderMessage($title, $text, $icon, $redirect = "maindashboard.php")
{
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>$title</title>
        <style>
            body {
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background: #f8f9fa;
            }
            iframe {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border: none;
                z-index: 0;
            }
            #popup {
                position: absolute;
                z-index: 9999;
            }
        </style>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <iframe src='$redirect'></iframe>
        <div id='popup'>
            <script>
                Swal.fire({
                    title: '$title',
                    text: '$text',
                    icon: '$icon',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '$redirect';
                });
            </script>
        </div>
    </body>
    </html>";
    exit;
}

// Check if the request matches daycare form
if (
    isset($_POST['student_first_name'], $_POST['student_middle_name'], $_POST['student_last_name'], $_POST['kinder_level'], 
          $_POST['guardian_first_name'], $_POST['guardian_middle_name'], $_POST['guardian_last_name'], $_POST['guardian_age'], $_POST['guardian_contact_num']) &&
    isset($_FILES['health_record'], $_FILES['birth_cert'], $_FILES['guardian_id']) &&
    $_FILES['health_record']['error'] === UPLOAD_ERR_OK &&
    $_FILES['birth_cert']['error'] === UPLOAD_ERR_OK &&
    $_FILES['guardian_id']['error'] === UPLOAD_ERR_OK
) {
    // Daycare form handling
    $student_fname = $_POST['student_first_name'];
    $student_mname = $_POST['student_middle_name'];
    $student_lname = $_POST['student_last_name'];
    $student_level = $_POST['kinder_level'];

    $guardian_fname = $_POST['guardian_first_name'];
    $guardian_mname = $_POST['guardian_middle_name'];
    $guardian_lname = $_POST['guardian_last_name'];
    $guardian_age = intval($_POST['guardian_age']);
    $guardian_contactnum = $_POST['guardian_contact_num'];

    $student_healthrecord = $_FILES['health_record']['name'];
    $healthrecord_path = $target_dir . basename($student_healthrecord);
    if (!move_uploaded_file($_FILES['health_record']['tmp_name'], $healthrecord_path)) {
        renderMessage("Error", "Failed to upload health record.", "error");
    }

    $student_birthcert = $_FILES['birth_cert']['name'];
    $birthcert_path = $target_dir . basename($student_birthcert);
    if (!move_uploaded_file($_FILES['birth_cert']['tmp_name'], $birthcert_path)) {
        renderMessage("Error", "Failed to upload birth certificate.", "error");
    }

    $guardian_id = $_FILES['guardian_id']['name'];
    $guardian_id_path = $target_dir . basename($guardian_id);
    if (!move_uploaded_file($_FILES['guardian_id']['tmp_name'], $guardian_id_path)) {
        renderMessage("Error", "Failed to upload guardian ID.", "error");
    }

    // Add username to the query
    $sql = "INSERT INTO daycare_shortlisting (
                student_fname, student_mname, student_lname, student_healthrecord, 
                student_birthcert, student_level, guardian_fname, guardian_mname, 
                guardian_lname, guardian_age, guardian_id, guardian_contactnum, username
            ) VALUES (
                '$student_fname', '$student_mname', '$student_lname', '$student_healthrecord', 
                '$student_birthcert', '$student_level', '$guardian_fname', '$guardian_mname', 
                '$guardian_lname', $guardian_age, '$guardian_id', '$guardian_contactnum', '$current_username'
            )";

    if ($conn->query($sql) === TRUE) {
        renderMessage("Success", "Record added successfully.", "success");
    } else {
        renderMessage("Error", "Error inserting record: " . $conn->error, "error");
    }
}
// Check if the request matches building clearance form
elseif (isset($_POST['measurement']) && isset($_FILES['lot_cert']) && $_FILES['lot_cert']['error'] === UPLOAD_ERR_OK) {
    $measurement = $_POST['measurement'];
    $lot_cert = $_FILES['lot_cert']['name'];

    $lot_cert_path = $target_dir . basename($lot_cert);

    if (move_uploaded_file($_FILES['lot_cert']['tmp_name'], $lot_cert_path)) {
        // Add username to the query
        $sql = "INSERT INTO blgclearance_cert (
                    first_name, middle_name, last_name, lot_cert, measurement, apply_myself, username
                ) VALUES (
                    '$first_name', '$middle_name', '$last_name', '$lot_cert', '$measurement', '$apply_myself', '$current_username'
                )";

        if ($conn->query($sql) === TRUE) {
            renderMessage("Success", "Record added successfully.", "success");
        } else {
            renderMessage("Error", "Error inserting record: " . $conn->error, "error");
        }
    } else {
        renderMessage("Error", "Failed to upload lot certification.", "error");
    }
} 
// Default error for missing or invalid inputs
else {
    renderMessage("Error", "One or more files are missing, or inputs are invalid.", "error");
}

$conn->close();
?>
