<?php
require 'connectdb.php';

// Queries for all the tables
$indigencyQuery = "SELECT * FROM indigency_cert";
$residencyQuery = "SELECT * FROM residency_cert";
$jobAbsenceQuery = "SELECT * FROM jobabsence_cert";
$jobSeekQuery = "SELECT * FROM jobseek_cert";
$soloParentQuery = "SELECT * FROM soloparent_cert";

// Execute queries
$indigencyResult = mysqli_query($conn, $indigencyQuery);
$residencyResult = mysqli_query($conn, $residencyQuery);
$jobAbsenceResult = mysqli_query($conn, $jobAbsenceQuery);
$jobSeekResult = mysqli_query($conn, $jobSeekQuery);
$soloParentResult = mysqli_query($conn, $soloParentQuery);

// Display data for Certificate of Indigency
while ($row = mysqli_fetch_assoc($indigencyResult)) {
    echo '<div id="servicesdiv" class="servicesdiv"  style="display: none;">';
    echo '<div class="servetype">';
    echo '<h4>Types of Services:</h4>';
    echo '<div class="details"><p class="typeofservice">Certificate of Indigency</p></div>';
    echo '<h4>Details:</h4>';
    echo '<div class="details">';
    echo '<p class="surname">' . $row['last_name'] . '</p>';
    echo '<p class="firstname">' . $row['first_name'] . '</p>';
    echo '</div>';
    echo '<div class="details">';
    echo '<p class="age">' . $row['age'] . '</p>';
    echo '<p class="idpicture"><a href="uploads/' . $row['id_pic'] . '" target="_blank">View ID Picture</a></p>';
    echo '<p class="type">' . $row['assistance_type'] . '</p>';
    echo '</div>';
    echo '</div>';

    // Notification and delete section
    echo '<div class="notification" id="notifanddelete">';
    echo '<h4>Write a notification:</h4>';
    echo '<textarea class="txt4" name="notification" placeholder="Write here" required></textarea>';
    echo '<button class="sendnofit">Send</button>';
    echo '</div>';
    echo '<div class="delele" id="notifanddelete">';
    echo '<button class="deletenotif">Delete</button>';
    echo '</div>';

    echo '</div>';
}

// Display data for Certificate of Residency
while ($row = mysqli_fetch_assoc($residencyResult)) {
    echo '<div class="servicesdiv">';
    echo '<div class="servetype">';
    echo '<h4>Types of Services:</h4>';
    echo '<div class="details"><p class="typeofservice">Certificate of Residency</p></div>';
    echo '<h4>Details:</h4>';
    echo '<div class="details">';
    echo '<p class="surname">' . $row['last_name'] . '</p>';
    echo '<p class="firstname">' . $row['first_name'] . '</p>';
    echo '</div>';
    echo '<div class="details">';
    echo '<p class="age">' . $row['yrs_occupancy'] . ' years</p>';  // Replacing age with yrs_occupancy
    echo '<p class="idpicture"><a href="uploads/' . $row['id_pic'] . '" target="_blank">View ID Picture</a></p>';
    echo '<p class="type">Address: ' . $row['address'] . '</p>';
    echo '</div>';
    echo '</div>';

    // Notification and delete section
    echo '<div class="notification" id="notifanddelete">';
    echo '<h4>Write a notification:</h4>';
    echo '<textarea class="txt4" name="notification" placeholder="Write here" required></textarea>';
    echo '<button class="sendnofit">Send</button>';
    echo '</div>';
    echo '<div class="delele" id="notifanddelete">';
    echo '<button class="deletenotif">Delete</button>';
    echo '</div>';

    echo '</div>';
}

// Display data for Certificate of Job Absence
while ($row = mysqli_fetch_assoc($jobAbsenceResult)) {
    echo '<div class="servicesdiv">';
    echo '<div class="servetype">';
    echo '<h4>Types of Services:</h4>';
    echo '<div class="details"><p class="typeofservice">Certificate of Job Absence</p></div>';
    echo '<h4>Details:</h4>';
    echo '<div class="details">';
    echo '<p class="surname">' . $row['last_name'] . '</p>';
    echo '<p class="firstname">' . $row['first_name'] . '</p>';
    echo '</div>';
    echo '<div class="details">';
    echo '<p class="age">' . $row['duration'] . '</p>';  // Replacing age with duration
    echo '<p class="idpicture"><a href="uploads/' . $row['id_pic'] . '" target="_blank">View ID Picture</a></p>';
    echo '<p class="type">' . $row['employer'] . '</p>';
    echo '</div>';
    echo '</div>';

    // Notification and delete section
    echo '<div class="notification" id="notifanddelete">';
    echo '<h4>Write a notification:</h4>';
    echo '<textarea class="txt4" name="notification" placeholder="Write here" required></textarea>';
    echo '<button class="sendnofit">Send</button>';
    echo '</div>';
    echo '<div class="delele" id="notifanddelete">';
    echo '<button class="deletenotif">Delete</button>';
    echo '</div>';

    echo '</div>';
}

// Display data for Certificate of Job Seeking
while ($row = mysqli_fetch_assoc($jobSeekResult)) {
    echo '<div class="servicesdiv">';
    echo '<div class="servetype">';
    echo '<h4>Types of Services:</h4>';
    echo '<div class="details"><p class="typeofservice">Certificate of Job Seeking</p></div>';
    echo '<h4>Details:</h4>';
    echo '<div class="details">';
    echo '<p class="surname">' . $row['last_name'] . '</p>';
    echo '<p class="firstname">' . $row['first_name'] . '</p>';
    echo '</div>';
    echo '<div class="details">';
    echo '<p class="age">' . $row['employer'] . '</p>';  // Replacing age with employer for Job Seeking
    echo '<p class="idpicture"><a href="uploads/' . $row['id_pic'] . '" target="_blank">View ID Picture</a></p>';
    echo '</div>';
    echo '</div>';

    // Notification and delete section
    echo '<div class="notification" id="notifanddelete">';
    echo '<h4>Write a notification:</h4>';
    echo '<textarea class="txt4" name="notification" placeholder="Write here" required></textarea>';
    echo '<button class="sendnofit">Send</button>';
    echo '</div>';
    echo '<div class="delele" id="notifanddelete">';
    echo '<button class="deletenotif">Delete</button>';
    echo '</div>';

    echo '</div>';
}

// Display data for Certificate of Solo Parenting
while ($row = mysqli_fetch_assoc($soloParentResult)) {
    echo '<div class="servicesdiv">';
    echo '<div class="servetype">';
    echo '<h4>Types of Services:</h4>';
    echo '<div class="details"><p class="typeofservice">Certificate of Solo Parenting</p></div>';
    echo '<h4>Details:</h4>';
    echo '<div class="details">';
    echo '<p class="surname">' . $row['last_name'] . '</p>';
    echo '<p class="firstname">' . $row['first_name'] . '</p>';
    echo '</div>';
    echo '<div class="details">';
    echo '<p class="age">' . $row['num_children'] . ' children</p>';  // Replacing age with num_children
    echo '<p class="idpicture"><a href="uploads/' . $row['id_pic'] . '" target="_blank">View ID Picture</a></p>';
    echo '<p class="type">' . $row['monthly_income'] . '</p>';
    echo '</div>';
    echo '</div>';

    // Notification and delete section
    echo '<div class="notification" id="notifanddelete">';
    echo '<h4>Write a notification:</h4>';
    echo '<textarea class="txt4" name="notification" placeholder="Write here" required></textarea>';
    echo '<button class="sendnofit">Send</button>';
    echo '</div>';
    echo '<div class="delele" id="notifanddelete">';
    echo '<button class="deletenotif">Delete</button>';
    echo '</div>';

    echo '</div>';
}
?>
