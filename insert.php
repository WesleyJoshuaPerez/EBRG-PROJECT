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

    } else if (isset($_POST['yrs_of_occupancy']) && isset($_POST['address'])) {
        // Residency certificate
        $yrs_of_occupancy = $_POST['yrs_of_occupancy'];
        $address = $_POST['address'];
        $sql = "INSERT INTO residency_cert (first_name, middle_name, last_name, yrs_occupancy, address, id_pic, apply_myself)
                VALUES ('$first_name', '$middle_name', '$last_name', '$yrs_of_occupancy', '$address', '$id_pic', '$apply_myself')";

    } else if (isset($_POST['employer']) && isset($_POST['absence_date']) && isset($_POST['duration']) && isset($_POST['reason'])) {
        // Job absence certificate
        $employer = $_POST['employer'];
        $absence_date = $_POST['absence_date'];
        $duration = $_POST['duration'];
        $reason = $_POST['reason'];
        $sql = "INSERT INTO jobabsence_cert (first_name, middle_name, last_name, id_pic, employer, absence_date, duration, reason, apply_myself)
                VALUES ('$first_name', '$middle_name', '$last_name', '$id_pic', '$employer', '$absence_date', '$duration', '$reason', '$apply_myself')";

    } else if (isset($_POST['employer'])) {
        // First-time job seeker certificate
        $employer = $_POST['employer'];
        $sql = "INSERT INTO jobseek_cert (first_name, middle_name, last_name, id_pic, employer, apply_myself)
                VALUES ('$first_name', '$middle_name', '$last_name', '$id_pic', '$employer', '$apply_myself')";

    } else if (isset($_POST['years_of_separation']) && isset($_POST['num_children']) && isset($_POST['source_income']) && isset($_POST['monthly_income'])) {
        // Solo parent certificate
        $years_of_separation = $_POST['years_of_separation'];
        $num_children = $_POST['num_children'];
        $source_income = $_POST['source_income'];
        $monthly_income = $_POST['monthly_income'];
        $sql = "INSERT INTO soloparent_cert (first_name, middle_name, last_name, id_pic, years_of_separation, num_children, monthly_income, source_income, apply_myself)
                VALUES ('$first_name', '$middle_name', '$last_name','$id_pic', '$years_of_separation', '$num_children', '$monthly_income', '$source_income', '$apply_myself')";

    } else if (isset($_POST['yrs_occupancy'])) {
        // Certificate of Barangay Clearance fields
        $yrs_occupancy = $_POST['yrs_occupancy'];

        // Insert data into the database for barangay clearance
        $sql = "INSERT INTO brgyclearance_cert (first_name, middle_name, last_name, age, id_pic, yrs_occupancy, apply_myself)
                VALUES ('$first_name', '$middle_name', '$last_name', '$age', '$id_pic', '$yrs_occupancy', '$apply_myself')";

    } else if (isset($_POST['address']) && isset($_FILES['lot_cert']) && $_FILES['lot_cert']['error'] === UPLOAD_ERR_OK) {
        // Certificate of Fencing Clearance fields
        $address = $_POST['address'];
        $lot_cert = $_FILES['lot_cert']['name'];

        // Handle file upload
        $target_dir = "uploads/";
        $lot_cert_path = $target_dir . basename($lot_cert);

        if (move_uploaded_file($_FILES['lot_cert']['tmp_name'], $lot_cert_path)) {
            // Insert data into the database for fencing clearance
            $sql = "INSERT INTO fencingclearance_cert (first_name, middle_name, last_name, id_pic, lot_cert, address, apply_myself)
                    VALUES ('$first_name', '$middle_name', '$last_name', '$id_pic', '$lot_cert', '$address', '$apply_myself')";
        }
    
    } else if (isset($_POST['business_name']) && isset($_POST['business_type']) && isset($_POST['business_address'])) {
        // Order of Payment
        $business_name = $_POST['business_name'];   
        $business_type = $_POST['business_type'];
        $business_address = $_POST['business_address'];

        // insertion
        $sql = "INSERT INTO order_payment (first_name, middle_name, last_name, id_pic, business_name, business_type, business_address, apply_myself)
                VALUES ('$first_name', '$middle_name', '$last_name', '$id_pic', '$business_name', '$business_type', '$business_address', '$apply_myself')";

    } else if (isset($_POST['last_name']) && isset($_FILES['lot_cert']) && $_FILES['lot_cert']['error'] === UPLOAD_ERR_OK) {
        // electricity installation clearance
        $last_name = $_POST['last_name'];
        $lot_cert = $_FILES['lot_cert']['name'];

        // Handle file upload
        $target_dir = "uploads/";
        $lot_cert_path = $target_dir . basename($lot_cert);

        if (move_uploaded_file($_FILES['lot_cert']['tmp_name'], $lot_cert_path)) {
            // Insert data into the database for electricity clearance
            $sql = "INSERT INTO electricity_clearance (first_name, middle_name, last_name, id_pic, lot_cert, apply_myself)
                    VALUES ('$first_name', '$middle_name', '$last_name', '$id_pic', '$lot_cert', '$apply_myself')";
        } 

    } else if ($_FILES['health_record']['error'] === UPLOAD_ERR_OK &&
    $_FILES['birth_cert']['error'] === UPLOAD_ERR_OK &&
    $_FILES['guardian_id']['error'] === UPLOAD_ERR_OK) {

    // Student's information
    $student_fname = $_POST['first_name'];
    $student_mname = $_POST['middle_name'];
    $student_lname = $_POST['last_name'];
    $student_level = $_POST['kinder_level'];

    // Guardian's information
    $guardian_fname = $_POST['first_name'];
    $guardian_mname = $_POST['middle_name'];
    $guardian_lname = $_POST['last_name'];
    $guardian_age = $_POST['age'];
    $guardian_contactnum = $_POST['contact_num'];

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

    } else {
            // else handler here
            echo "No matching condition found for the provided data.";
            $sql = null; // Set $sql to null to avoid executing an undefined query
        }
    
    

    // Execute the query if $sql is set
    if (isset($sql) && !empty($sql)) {
        if ($conn->query($sql) === TRUE) {
            echo "Record added successfully";
        } else {
            echo "Error executing query: " . $conn->error;
        }
    } else {
        echo "Error: SQL query is not defined or input conditions are not met.";
    }
}      
  
    
    $conn->close();
    ?>
    
    