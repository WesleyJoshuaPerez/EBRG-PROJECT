<?php
include 'connectdb.php'; // Your database connection file

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check tables in the database
$result = $conn->query("SHOW TABLES");
if ($result->num_rows > 0) {
    echo "Tables in database 'ebrgy':<br>";
    while ($row = $result->fetch_row()) {
        echo $row[0] . "<br>"; // Output table names
    }
} else {
    echo "No tables found in the database.";
}

$conn->close();
?>