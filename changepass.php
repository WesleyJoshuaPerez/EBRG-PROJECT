<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="shortcut icon" type="x-icon" href="logo/logo.png">
    <link rel="stylesheet" href="styles-changepass.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:ital,wght@0,1..1000;1,1..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="change-password-container">
        <h1>Change Password</h1>
        <form action="" method="post">
            <input type="hidden" name="code" value="<?php echo $_GET['code']; ?>">
            <div class="form-container">
                <label for="email" class="email-label">Email Address</label>
                <input type="email" id="email" placeholder="Enter Email Address" class="email-input" name="email" required>

                <label for="new-password" class="email-label">New Password</label>
                <input type="password" id="new-password" placeholder="Enter New Password" class="email-input" name="new_password" required>

                <label for="confirm-password" class="email-label">Confirm Password</label>
                <input type="password" id="confirm-password" placeholder="Enter Confirmed Password" class="email-input" name="confirm_password" required>

                <button type="submit" class="update-button" name="update">Update Password</button>
            </div>
        </form>
    </div>

   <?php
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $conn = new mysqli('localhost', 'root', '', 'ebrgy');
    if ($conn->connect_error) {
        die('Could not connect to the database');
    }

    $verifyQuery = $conn->prepare("SELECT * FROM resetpass_request WHERE reset_token = ? AND (request_date IS NULL OR request_date >= NOW() - INTERVAL 1 DAY)");
    $verifyQuery->bind_param("s", $code);
    $verifyQuery->execute();
    $result = $verifyQuery->get_result();

    $alertTitle = '';
    $alertText = '';
    $alertIcon = '';
    $redirectUrl = 'changepass.php'; // Default to changepass.php on failure

    if ($result->num_rows == 0) {
        $alertTitle = 'Changing password failed!';
        $alertText = 'Invalid or expired reset code.';
        $alertIcon = 'error';
        $redirectUrl = 'index.php';
    } elseif (isset($_POST['update'])) {
        $email = $_POST['email'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password !== $confirm_password) {
            $alertTitle = 'Changing password failed!';
            $alertText = 'Passwords do not match. Please try again.';
            $alertIcon = 'error';
        } else {
            $updateQuery = $conn->prepare("UPDATE registereduser_ebrg SET password = ?, updated_time = NOW() WHERE email = ? AND code = ?");
            $updateQuery->bind_param("sss", $new_password, $email, $code);
            $updateQuery->execute();

            if ($updateQuery->affected_rows > 0) {
                // Password was successfully updated
                $alertTitle = 'Password update successful!';
                $alertText = 'Click OK to go to the login page.';
                $alertIcon = 'success';
                $redirectUrl = 'index.php';
            } else {
                // No rows were updated, meaning the email or code was incorrect
                $alertTitle = 'Password update failed!';
                $alertText = 'Invalid email or reset code.';
                $alertIcon = 'error';
            }
        }
    }

    // Clean up
    $verifyQuery->close();
    $conn->close();

    // Output SweetAlert2 script if there is an alert
    if ($alertTitle && $alertText && $alertIcon) {
        echo "<script>
            Swal.fire({
                title: '$alertTitle',
                text: '$alertText',
                icon: '$alertIcon'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '$redirectUrl';
                }
            });
        </script>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>

</body>
</html>
