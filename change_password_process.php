<?php
if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Establish database connection
    $conn = new mysqli('localhost', 'root', '', 'ebrgy');
    if ($conn->connect_error) {
        die('Could not connect to the database');
    }

    // Check if the reset code is valid and the reset attempt is within 1 day, or if updated_time is NULL
    $verifyQuery = $conn->prepare("SELECT * FROM registereduser_ebrg WHERE code = ? AND (updated_time IS NULL OR updated_time >= NOW() - INTERVAL 1 DAY)");
    $verifyQuery->bind_param("s", $code);
    $verifyQuery->execute();
    $result = $verifyQuery->get_result();

    if ($result->num_rows == 0) {
        echo "Invalid or expired reset code.";
        header("Location: index.php");
        exit();
    }

    // Process the password update
    if (isset($_POST['update'])) {
        $email = $_POST['email'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if new password and confirm password match
        if ($new_password !== $confirm_password) {
            echo "Passwords do not match. Please try again.";
            exit();
        }

        // Directly update the password without hashing
        $updateQuery = $conn->prepare("UPDATE registereduser_ebrg SET password = ?, updated_time = NOW() WHERE email = ? AND code = ?");
        $updateQuery->bind_param("sss", $new_password, $email, $code);

        if ($updateQuery->execute()) {
            header("Location: success.html");
            exit();
        } else {
            echo "Failed to update password. Error: " . $conn->error;
        }
    }

    // Clean up
    $verifyQuery->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>