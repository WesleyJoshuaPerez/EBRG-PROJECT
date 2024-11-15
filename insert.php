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
$age = isset($_POST['age']) ? $_POST['age'] : null; // Age may not be in all forms
$assistance_type = isset($_POST['assistance_type']) ? $_POST['assistance_type'] : null;
$apply_myself = isset($_POST['apply_myself']) ? $_POST['apply_myself'] : null; // Retrieve radio button value if set

// Handle file upload
$id_pic = isset($_FILES['id_pic']['name']) ? $_FILES['id_pic']['name'] : null;
$target_dir = "uploads/";
$target_file = $target_dir . basename($id_pic);

// Move uploaded file to the target directory only if a file is uploaded
if ($id_pic && move_uploaded_file($_FILES["id_pic"]["tmp_name"], $target_file)) {

    // Check if it's an indigency certificate or residency certificate
    if (isset($age) && isset($assistance_type)) {
        // Insert data into the database for indigency certificate
        $sql = "INSERT INTO indigency_cert (first_name, middle_name, last_name, age, id_pic, assistance_type, apply_myself)
                VALUES ('$first_name', '$middle_name', '$last_name', '$age', '$id_pic', '$assistance_type', '$apply_myself')";
    
    } else if (isset($_POST['yrs_of_occupancy']) && isset($_POST['address'])) {
        // Certificate of Residency fields
        $yrs_of_occupancy = $_POST['yrs_of_occupancy'];
        $address = $_POST['address'];
    
        // Insert data into the database for residency
        $sql = "INSERT INTO residency_cert (first_name, middle_name, last_name, yrs_occupancy, address, id_pic, apply_myself)
                VALUES ('$first_name', '$middle_name', '$last_name', '$yrs_of_occupancy', '$address', '$id_pic', '$apply_myself')";
    
    } else if (isset($_POST['employer']) && isset($_POST['absence_date']) && isset($_POST['duration']) && isset($_POST['reason'])) {
        // Certificate of Job Absence fields
        $employer = $_POST['employer'];
        $absence_date = $_POST['absence_date'];
        $duration = $_POST['duration'];
        $reason = $_POST['reason'];
    
        // Insert data into the database for job absence 
        $sql = "INSERT INTO jobabsence_cert (first_name, middle_name, last_name, id_pic, employer, absence_date, duration, reason, apply_myself)
                VALUES ('$first_name', '$middle_name', '$last_name','$id_pic', '$employer', '$absence_date', '$duration', '$reason', '$apply_myself')";
    
    } else if (isset($_POST['employer'])) {
        // Certificate of First Time Job Seeker fields
        $employer = $_POST['employer'];
    
        // Insert data into the database for first time job seeker
        $sql = "INSERT INTO jobseek_cert (first_name, middle_name, last_name, id_pic, employer, apply_myself)
                VALUES ('$first_name', '$middle_name', '$last_name','$id_pic', '$employer', '$apply_myself')"; 
    } else {
        // Insert data into the database for indigency certificate with default values if assistance_type or age are not set
        $sql = "INSERT INTO indigency_cert (first_name, middle_name, last_name, age, id_pic, assistance_type, apply_myself)
                VALUES ('$first_name', '$middle_name', '$last_name', NULL, '$id_pic', NULL, '$apply_myself')";
    }
    
    
 

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} else {
    echo "Error uploading file or no file uploaded.";
}

$conn->close();
?>
