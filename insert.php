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

// Retrieve common form data
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$age = isset($_POST['age']) ? $_POST['age'] : null; // Optional fields
$assistance_type = isset($_POST['assistance_type']) ? $_POST['assistance_type'] : null;
$apply_myself = isset($_POST['apply_myself']) ? $_POST['apply_myself'] : null; // Radio button value

// Handle file upload
$id_pic = isset($_FILES['id_pic']['name']) ? $_FILES['id_pic']['name'] : null;
$target_dir = "uploads/";
$target_file = $target_dir . basename($id_pic);

if ($id_pic && move_uploaded_file($_FILES["id_pic"]["tmp_name"], $target_file)) {
    // Determine appropriate query based on provided fields
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
    } else {
        // Handle case with no matching condition
        $sql = null;
    }

    if ($sql !== null && $conn->query($sql) === TRUE) {
        // Redirect with success status
        header("Location: maindashboard.php?status=success");
        exit();
    } else {
        // Redirect with error status
        header("Location: maindashboard.php?status=error");
        exit();
    }
} else {
    // Redirect with file upload error
    header("Location: maindashboard.php?status=file_error");
    exit();
}

// Close the connection
$conn->close();
?>
