<?php
// Include database connection
include 'connectdb.php';

// Start session to get logged-in user's username
session_start();

// Check if username exists in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Query the database for firstname, middlename, lastname, and birthday
    $query = "SELECT firstname, middlename, lastname, birthday FROM registereduser_ebrg WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Calculate the user's age
        $currentDate = new DateTime();
        $birthday = new DateTime($row['birthday']);
        $age = $currentDate->diff($birthday)->y;

        // Return firstname, middlename, lastname, and age as JSON
        echo json_encode([
            'status' => 'success',
            'firstname' => $row['firstname'],
            'middlename' => $row['middlename'],
            'lastname' => $row['lastname'],
            'age' => $age
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No user logged in']);
}
?>
