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

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Common form data
    $first_name = $_POST['first_name'] ?? '';
    $middle_name = $_POST['middle_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $age = $_POST['age'] ?? null; // Optional
    $assistance_type = $_POST['assistance_type'] ?? null;
    $apply_myself = $_POST['apply_myself'] ?? null;

    // File upload handling
    $id_pic = $_FILES['id_pic']['name'] ?? null;
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($id_pic);

    if ($id_pic && move_uploaded_file($_FILES["id_pic"]["tmp_name"], $target_file)) {
        // Determine the type of certificate and perform the appropriate query
        if (isset($age) && isset($assistance_type)) {
            // Indigency certificate
            $sql = "INSERT INTO indigency_cert (first_name, middle_name, last_name, age, id_pic, assistance_type, apply_myself)
                    VALUES ('$first_name', '$middle_name', '$last_name', '$age', '$id_pic', '$assistance_type', '$apply_myself')";
        } elseif (isset($_POST['yrs_of_occupancy']) && isset($_POST['address'])) {
            // Residency certificate
            $yrs_of_occupancy = $_POST['yrs_of_occupancy'];
            $address = $_POST['address'];
            $sql = "INSERT INTO residency_cert (first_name, middle_name, last_name, yrs_occupancy, address, id_pic, apply_myself)
                    VALUES ('$first_name', '$middle_name', '$last_name', '$yrs_of_occupancy', '$address', '$id_pic', '$apply_myself')";
        } elseif (isset($_POST['employer']) && isset($_POST['absence_date']) && isset($_POST['duration']) && isset($_POST['reason'])) {
            // Job absence certificate
            $employer = $_POST['employer'];
            $absence_date = $_POST['absence_date'];
            $duration = $_POST['duration'];
            $reason = $_POST['reason'];
            $sql = "INSERT INTO jobabsence_cert (first_name, middle_name, last_name, id_pic, employer, absence_date, duration, reason, apply_myself)
                    VALUES ('$first_name', '$middle_name', '$last_name', '$id_pic', '$employer', '$absence_date', '$duration', '$reason', '$apply_myself')";
        } elseif (isset($_POST['employer'])) {
            // First-time job seeker certificate
            $employer = $_POST['employer'];
            $sql = "INSERT INTO jobseek_cert (first_name, middle_name, last_name, id_pic, employer, apply_myself)
                    VALUES ('$first_name', '$middle_name', '$last_name', '$id_pic', '$employer', '$apply_myself')";
        } elseif (isset($_POST['years_of_separation']) && isset($_POST['num_children']) && isset($_POST['source_income']) && isset($_POST['monthly_income'])) {
            // Solo parent certificate
            $years_of_separation = $_POST['years_of_separation'];
            $num_children = $_POST['num_children'];
            $source_income = $_POST['source_income'];
            $monthly_income = $_POST['monthly_income'];
            $sql = "INSERT INTO soloparent_cert (first_name, middle_name, last_name, id_pic, years_of_separation, num_children, monthly_income, source_income, apply_myself)
                    VALUES ('$first_name', '$middle_name', '$last_name', '$id_pic', '$years_of_separation', '$num_children', '$monthly_income', '$source_income', '$apply_myself')";
        } elseif (isset($_POST['yrs_occupancy'])) {
            // Certificate of Barangay Clearance fields
            $yrs_occupancy = $_POST['yrs_occupancy'];

            // Insert data into the database for barangay clearance
            $sql = "INSERT INTO brgyclearance_cert (first_name, middle_name, last_name, age, id_pic, yrs_occupancy, apply_myself)
                    VALUES ('$first_name', '$middle_name', '$last_name', '$age', '$id_pic', '$yrs_occupancy', '$apply_myself')";
        } elseif (isset($_POST['address']) && isset($_FILES['lot_cert']) && $_FILES['lot_cert']['error'] === UPLOAD_ERR_OK) {
            // Certificate of Fencing Clearance fields
            $address = $_POST['address'];
            $lot_cert = $_FILES['lot_cert']['name'];

            // Handle file upload
            $lot_cert_path = $target_dir . basename($lot_cert);

            if (move_uploaded_file($_FILES['lot_cert']['tmp_name'], $lot_cert_path)) {
                // Insert data into the database for fencing clearance
                $sql = "INSERT INTO fencingclearance_cert (first_name, middle_name, last_name, id_pic, lot_cert, address, apply_myself)
                        VALUES ('$first_name', '$middle_name', '$last_name', '$id_pic', '$lot_cert', '$address', '$apply_myself')";
            }
        } elseif (isset($_POST['business_name']) && isset($_POST['business_type']) && isset($_POST['business_address'])) {
            // Order of Payment
            $business_name = $_POST['business_name'];
            $business_type = $_POST['business_type'];
            $business_address = $_POST['business_address'];

            // insertion
            $sql = "INSERT INTO order_payment (first_name, middle_name, last_name, id_pic, business_name, business_type, business_address, apply_myself)
                    VALUES ('$first_name', '$middle_name', '$last_name', '$id_pic', '$business_name', '$business_type', '$business_address', '$apply_myself')";
        } elseif (isset($_POST['last_name']) && isset($_FILES['lot_cert']) && $_FILES['lot_cert']['error'] === UPLOAD_ERR_OK) {
            // Electricity installation clearance
            $lot_cert = $_FILES['lot_cert']['name'];

            // Handle file upload
            $lot_cert_path = $target_dir . basename($lot_cert);

            if (move_uploaded_file($_FILES['lot_cert']['tmp_name'], $lot_cert_path)) {
                // Insert data into the database for electricity clearance
                $sql = "INSERT INTO electricity_clearance (first_name, middle_name, last_name, id_pic, lot_cert, apply_myself)
                        VALUES ('$first_name', '$middle_name', '$last_name', '$id_pic', '$lot_cert', '$apply_myself')";
            }
        } else {
            echo "No matching condition found for the provided data.";
            $sql = null; // Set $sql to null to avoid executing an undefined query
        }

        // Execute the query
        if (isset($sql) && $conn->query($sql) === TRUE) {
            echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Success</title>
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
                        window.location.href = 'maindashboard.php'; // Redirect back to the form page
                    });
                </script>
            </body>
            </html>";
        } else {
            echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Error</title>
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
                        window.location.href = 'form_page.php';
                    });
                </script>
            </body>
            </html>";
        }
    }
}        

$conn->close();
?>
