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

$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$apply_myself = isset($_POST['apply_myself']) ? $_POST['apply_myself'] : null; // Radio button value

// Debug uploaded files (can be commented out in production)
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";

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

    $target_dir = "uploads/";

    $student_healthrecord = $_FILES['health_record']['name'];
    $healthrecord_path = $target_dir . basename($student_healthrecord);
    if (!move_uploaded_file($_FILES['health_record']['tmp_name'], $healthrecord_path)) {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to upload health record.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
        exit;
    }

    $student_birthcert = $_FILES['birth_cert']['name'];
    $birthcert_path = $target_dir . basename($student_birthcert);
    if (!move_uploaded_file($_FILES['birth_cert']['tmp_name'], $birthcert_path)) {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to upload birth certificate.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
        exit;
    }

    $guardian_id = $_FILES['guardian_id']['name'];
    $guardian_id_path = $target_dir . basename($guardian_id);
    if (!move_uploaded_file($_FILES['guardian_id']['tmp_name'], $guardian_id_path)) {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to upload guardian ID.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
        exit;
    }

    $sql = "INSERT INTO daycare_shortlisting (
                student_fname, student_mname, student_lname, student_healthrecord, 
                student_birthcert, student_level, guardian_fname, guardian_mname, 
                guardian_lname, guardian_age, guardian_id, guardian_contactnum
            ) VALUES (
                '$student_fname', '$student_mname', '$student_lname', '$student_healthrecord', 
                '$student_birthcert', '$student_level', '$guardian_fname', '$guardian_mname', 
                '$guardian_lname', $guardian_age, '$guardian_id', '$guardian_contactnum'
            )";

    if ($conn->query($sql) === TRUE) {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Record added successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'maindashboard.php';
                });
            </script>
        </body>
        </html>";
    } else {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error inserting record: " . $conn->error . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
    }
}
// Check if the request matches building clearance form
elseif (isset($_POST['measurement']) && isset($_FILES['lot_cert']) && $_FILES['lot_cert']['error'] === UPLOAD_ERR_OK) {
    $measurement = $_POST['measurement'];
    $lot_cert = $_FILES['lot_cert']['name'];

    $target_dir = "uploads/";
    $lot_cert_path = $target_dir . basename($lot_cert);

    if (move_uploaded_file($_FILES['lot_cert']['tmp_name'], $lot_cert_path)) {
        $sql = "INSERT INTO blgclearance_cert (
                    first_name, middle_name, last_name, lot_cert, measurement, apply_myself
                ) VALUES (
                    '$first_name', '$middle_name', '$last_name', '$lot_cert', '$measurement', '$apply_myself'
                )";

        if ($conn->query($sql) === TRUE) {
            echo "<!DOCTYPE html>
            <html>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'Record added successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'maindashboard.php';
                    });
                </script>
            </body>
            </html>";
        } else {
            echo "<!DOCTYPE html>
            <html>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error inserting record: " . $conn->error . "',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.history.back();
                    });
                </script>
            </body>
            </html>";
        }
    } else {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to upload lot certification.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
    }
} 
// Default error for missing or invalid inputs
else {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'One or more files are missing, or inputs are invalid.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
                window.history.back();
            });
        </script>
    </body>
    </html>";
}

$conn->close();
?>
