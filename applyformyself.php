<?php
// Include database connection
include 'connectdb.php';

// Start session to get logged-in user's username
session_start();

// Check if username exists in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Query the database for firstname and lastname
    $query = "SELECT firstname, lastname FROM registereduser_ebrg WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            'status' => 'success',
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname']
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No user logged in']);
}
?>
