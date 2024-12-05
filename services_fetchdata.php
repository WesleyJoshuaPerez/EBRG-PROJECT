<?php
require 'connectdb.php';

// Queries for all the tables
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
    'electricity_clearance' => 'Electricity Installation Clearance',
    'daycare_shortlisting' => 'Daycare Shortlisting'
];

foreach ($tables as $table => $serviceName) {
    // Determine the ID column dynamically
    $idColumn = '';
    switch ($table) {
        case 'indigency_cert':
            $idColumn = 'indigency_id';
            break;
        case 'residency_cert':
            $idColumn = 'residency_id';
            break;
        case 'jobabsence_cert':
            $idColumn = 'jobabsence_id';
            break;
        case 'jobseek_cert':
            $idColumn = 'jobseek_id';
            break;
        case 'soloparent_cert':
            $idColumn = 'soloparent_id';
            break;
        case 'brgyclearance_cert':
            $idColumn = 'brgyclearance_id';
            break;
        case 'fencingclearance_cert':
            $idColumn = 'fencingclearance_id';
            break;
        case 'blgclearance_cert':
            $idColumn = 'blgclearance_id';
            break;
        case 'order_payment':
            $idColumn = 'orderpayment_id';
            break;
        case 'electricity_clearance':
            $idColumn = 'electricityclearance_id';
            break;
        case 'daycare_shortlisting':
            $idColumn = 'daycareshortlisting_id';
            break;
    }

    // Only select rows where current_status is is NULL 
    $query = "SELECT * FROM $table WHERE current_status IS NULL";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        

      
        switch ($table) {
            case 'indigency_cert':
            echo '<div class="servicesdiv">';
            echo '<div class="servetype">';
            echo '<h4>Types of Services:</h4>';
            echo '<div class="details"><p class="typeofservice">' . $serviceName . '</p></div>';
            echo '<h4>Details:</h4>';
            echo '<div class="details">';
            echo '<p class="surname">Lastname: ' . $row['last_name'] . '</p>';
            echo '<p class="firstname">Firstname: ' . $row['first_name'] . '</p>';
            echo '</div>';
              // Dynamic fields based on table
        echo '<div class="details">';
                echo '<p class="age">Age: ' . $row['age'] . '</p>';
                echo '<p class="type">Assistance Type: ' . $row['assistance_type'] . '</p>';
                echo '<p class="idpicture"><a href="uploads/' . $row['id_pic'] . '" target="_blank">View ID Picture</a></p>';
                break;
            case 'residency_cert':
            echo '<div class="servicesdiv">';
            echo '<div class="servetype">';
            echo '<h4>Types of Services:</h4>';
            echo '<div class="details"><p class="typeofservice">' . $serviceName . '</p></div>';
            echo '<h4>Details:</h4>';
            echo '<div class="details">';
            echo '<p class="surname">Lastname: ' . $row['last_name'] . '</p>';
            echo '<p class="firstname">Firstname: ' . $row['first_name'] . '</p>';
            echo '</div>';
              // Dynamic fields based on table
        echo '<div class="details">';
                echo '<p class="age">Years of Occupancy: ' . $row['yrs_occupancy'] . ' years</p>';
                echo '<p class="type">Address: ' . $row['address'] . '</p>';
                echo '<p class="idpicture"><a href="uploads/' . $row['id_pic'] . '" target="_blank">View ID Picture</a></p>';
                break;
            case 'jobabsence_cert':
            echo '<div class="servicesdiv">';
            echo '<div class="servetype">';
            echo '<h4>Types of Services:</h4>';
            echo '<div class="details"><p class="typeofservice">' . $serviceName . '</p></div>';
            echo '<h4>Details:</h4>';
            echo '<div class="details">';
            echo '<p class="surname">Lastname: ' . $row['last_name'] . '</p>';
            echo '<p class="firstname">Firstname: ' . $row['first_name'] . '</p>';
            echo '</div>';
              // Dynamic fields based on table
        echo '<div class="details">';
                echo '<p class="age">Duration: ' . $row['duration'] . '</p>';
                echo '<p class="type">Employer: ' . $row['employer'] . '</p>';
                echo '<p class="idpicture"><a href="uploads/' . $row['id_pic'] . '" target="_blank">View ID Picture</a></p>';
                break;
            case 'jobseek_cert':
            echo '<div class="servicesdiv">';
            echo '<div class="servetype">';
            echo '<h4>Types of Services:</h4>';
            echo '<div class="details"><p class="typeofservice">' . $serviceName . '</p></div>';
            echo '<h4>Details:</h4>';
            echo '<div class="details">';
            echo '<p class="surname">Lastname: ' . $row['last_name'] . '</p>';
            echo '<p class="firstname">Firstname: ' . $row['first_name'] . '</p>';
            echo '</div>';
              // Dynamic fields based on table
        echo '<div class="details">';
                echo '<p class="age">Employer: ' . $row['employer'] . '</p>';
                echo '<p class="idpicture"><a href="uploads/' . $row['id_pic'] . '" target="_blank">View ID Picture</a></p>';
                break;
            case 'soloparent_cert':
            echo '<div class="servicesdiv">';
            echo '<div class="servetype">';
            echo '<h4>Types of Services:</h4>';
            echo '<div class="details"><p class="typeofservice">' . $serviceName . '</p></div>';
            echo '<h4>Details:</h4>';
            echo '<div class="details">';
            echo '<p class="surname">Lastname: ' . $row['last_name'] . '</p>';
            echo '<p class="firstname">Firstname: ' . $row['first_name'] . '</p>';
            echo '</div>';
              // Dynamic fields based on table
        echo '<div class="details">';
                echo '<p class="age">Number of Children: ' . $row['num_children'] . '</p>';
                echo '<p class="type">Monthly Income: ' . $row['monthly_income'] . '</p>';
                echo '<p class="idpicture"><a href="uploads/' . $row['id_pic'] . '" target="_blank">View ID Picture</a></p>';
                break;
            case 'brgyclearance_cert':
            echo '<div class="servicesdiv">';
        echo '<div class="servetype">';
        echo '<h4>Types of Services:</h4>';
        echo '<div class="details"><p class="typeofservice">' . $serviceName . '</p></div>';
        echo '<h4>Details:</h4>';
        echo '<div class="details">';
        echo '<p class="surname">Lastname: ' . $row['last_name'] . '</p>';
        echo '<p class="firstname">Firstname: ' . $row['first_name'] . '</p>';
        echo '</div>';
              // Dynamic fields based on table
        echo '<div class="details">';
                echo '<p class="age">Age: ' . $row['age'] . '</p>';
                echo '<p class="type">Years of Occupancy: ' . $row['yrs_occupancy'] . '</p>';
                echo '<p class="idpicture"><a href="uploads/' . $row['id_pic'] . '" target="_blank">View ID Picture</a></p>';
                break;
            case 'fencingclearance_cert':
            echo '<div class="servicesdiv">';
            echo '<div class="servetype">';
            echo '<h4>Types of Services:</h4>';
            echo '<div class="details"><p class="typeofservice">' . $serviceName . '</p></div>';
            echo '<h4>Details:</h4>';
            echo '<div class="details">';
            echo '<p class="surname">Lastname: ' . $row['last_name'] . '</p>';
            echo '<p class="firstname">Firstname: ' . $row['first_name'] . '</p>';
            echo '</div>';
              // Dynamic fields based on table
        echo '<div class="details">';
                echo '<p class="age"><a href="uploads/' . $row['lot_cert'] . '" target="_blank">Updated Lot Certification</a></p>';
                echo '<p class="idpicture"><a href="uploads/' . $row['id_pic'] . '" target="_blank">View ID Picture</a></p>';
                echo '<p class="type">Address: ' . $row['address'] . '</p>';
                break;
            case 'blgclearance_cert':
            echo '<div class="servicesdiv">';
            echo '<div class="servetype">';
            echo '<h4>Types of Services:</h4>';
            echo '<div class="details"><p class="typeofservice">' . $serviceName . '</p></div>';
            echo '<h4>Details:</h4>';
            echo '<div class="details">';
            echo '<p class="surname">Lastname: ' . $row['last_name'] . '</p>';
            echo '<p class="firstname">Firstname: ' . $row['first_name'] . '</p>';
            echo '</div>';
              // Dynamic fields based on table
        echo '<div class="details">';
                echo '<p class="idpicture"><a href="uploads/' . $row['lot_cert'] . '" target="_blank">Updated Lot Certification</a></p>';
                echo '<p class="type">Lot Measurement in sqm: ' . $row['measurement'] . '</p>';
                break;
            case 'order_payment':
            echo '<div class="servicesdiv">';
            echo '<div class="servetype">';
            echo '<h4>Types of Services:</h4>';
            echo '<div class="details"><p class="typeofservice">' . $serviceName . '</p></div>';
            echo '<h4>Details:</h4>';
            echo '<div class="details">';
            echo '<p class="surname">Lastname: ' . $row['last_name'] . '</p>';
            echo '<p class="firstname">Firstname: ' . $row['first_name'] . '</p>';
            echo '</div>';
              // Dynamic fields based on table
        echo '<div class="details">';
                echo '<p class="age">Business Name: ' . $row['business_name'] . '</p>';
                echo '<p class="type">Business Address: ' . $row['business_address'] . '</p>';
                echo '<p class="idpicture"><a href="uploads/' . $row['id_pic'] . '" target="_blank">View ID Picture</a></p>';
                break;
            case 'electricity_clearance':
            echo '<div class="servicesdiv">';
            echo '<div class="servetype">';
            echo '<h4>Types of Services:</h4>';
            echo '<div class="details"><p class="typeofservice">' . $serviceName . '</p></div>';
            echo '<h4>Details:</h4>';
            echo '<div class="details">';
            echo '<p class="surname">Lastname: ' . $row['last_name'] . '</p>';
            echo '<p class="firstname">Firstname: ' . $row['first_name'] . '</p>';
            echo '</div>';
              // Dynamic fields based on table
        echo '<div class="details">';
                echo '<p class="type"><a href="uploads/' . $row['lot_cert'] . '" target="_blank">Updated Lot Certification</a></p>';
                echo '<p class="idpicture"><a href="uploads/' . $row['id_pic'] . '" target="_blank">View ID Picture</a></p>';
                break;
            case 'daycare_shortlisting':
                echo '<div class="servicesdiv">';
                echo '<div class="servetype">';
                echo '<h4>Types of Services:</h4>';
                echo '<div class="details"><p class="typeofservice">' . $serviceName . '</p></div>';
              
                echo '<h4>Details:</h4>';
                echo '<div class="details">';
                echo '<p class="surname">Student Name: ' . $row['student_fname'] . ' ' . ' ' . $row['student_lname'] . '</p>';
                echo '<p class="firstname">Guardian Name: ' . $row['guardian_fname'] .  ' ' . $row['guardian_lname'] . '</p>';
                echo '</div>';
                     // Dynamic fields based on table
        echo '<div class="details">';
                echo '<p class="age"><a href="uploads/' . $row['student_healthrecord'] . '" target="_blank">Student Healthrecord</a></p>';
                echo '<p class="type">Guardian Age: ' . $row['guardian_age'] .'</p>';
                echo '<p class="idpicture"><a href="uploads/' . $row['guardian_id'] . '" target="_blank">Guardian ID</a></p>';
                break;
        }

        echo '</div>';
        echo '</div>';

        // Notification and delete section
        echo '<div class="notification" id="notifanddelete">';
        echo '<h4>Write a notification:</h4>';
        echo '<textarea class="txt4" name="notification" placeholder="Write here" required></textarea>';
       // Display current date
       $currentDate = date('Y-m-d'); // Get current date in 'YYYY-MM-DD' format
       echo '<p>Date to pick-up:</p>'; // Display the current date
       echo '<input type="date" id="pickup_date" class="pickup_date" name="pickup_date" value="' . $currentDate . '" min="' . $currentDate . '">'; // Set min attribute to today's date
        echo '<button class="sendnofit" onclick="Checknotiftextarea(' .$row[$idColumn] . ', \'' . $table. '\')">Send</button>';;
        echo '</div>';
        echo '<div class="delele" id="notifanddelete">';
        echo '<button class="deletenotif" onclick="deleteRecord(' . $row[$idColumn] . ', \'' . $table . '\')">Delete</button>';
        echo '</div>';

        echo '</div>';
    }
}
?>
  <script>
   document.addEventListener("DOMContentLoaded", function() {
    const dateFields = document.querySelectorAll(".pickup_date"); // Select all elements with class 'pickup_date'

    dateFields.forEach(function(absenceDateField) {
        const today = new Date();
        const formattedDate = today.toISOString().split("T")[0]; // Format as yyyy-mm-dd
        absenceDateField.setAttribute("min", formattedDate); // Set minimum date to today
    });
});
    </script>
