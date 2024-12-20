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
            <div class="password-wrapper">
                <input type="password" id="new-password" placeholder="Enter New Password" class="email-input" name="new_password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility('new-password', this)">👁️</span>
            </div>
            <p id="password-feedback"style="color: red; font-size: 14px; display: none; margin-top: -25px;"></p> <!-- Feedback element for new password -->

            <label for="confirm-password" class="email-label">Confirm Password</label>
            <div class="password-wrapper">
                <input type="password" id="confirm-password" placeholder="Enter Confirmed Password" class="email-input" name="confirm_password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility('confirm-password', this)">👁️</span>
            </div>
            <p id="confirm-password-feedback" style="color: red; font-size: 14px; display: none; margin-top: -25px;"></p> <!-- Feedback element for confirm password -->
            
            <button type="submit" class="update-button" name="update">Update Password</button>
        </div>
    </form>
</div>


<?php
$alertTitle = '';
$alertText = '';
$alertIcon = '';
$redirectUrl = '';

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $conn = new mysqli('localhost', 'root', '', 'ebrgy');

    if ($conn->connect_error) {
        die('Could not connect to the database');
    }

    // Verify reset code and its expiration
    $verifyQuery = $conn->prepare("
        SELECT r.email 
        FROM resetpass_request r
        WHERE r.reset_token = ? 
        AND (r.request_date IS NULL OR r.request_date >= NOW() - INTERVAL 1 DAY)
    ");
    $verifyQuery->bind_param("s", $code);
    $verifyQuery->execute();
    $result = $verifyQuery->get_result();

    if ($result->num_rows == 0) {
        $alertTitle = 'Changing password failed!';
        $alertText = 'Invalid or expired reset code.';
        $alertIcon = 'error';
        $redirectUrl = 'index.php';
    } else {
        $user = $result->fetch_assoc();
        $email = $user['email']; // Retrieve email directly from resetpass_request table

        // Check if user is an admin by querying the admin_ebrgy table
        $checkAdminQuery = $conn->prepare("SELECT admin_id FROM admin_ebrgy WHERE email = ?");
        $checkAdminQuery->bind_param("s", $email);
        $checkAdminQuery->execute();
        $adminResult = $checkAdminQuery->get_result();

        // Determine the table to update based on whether the user is an admin
        if (isset($_POST['update'])) {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            if ($new_password !== $confirm_password) {
                $alertTitle = 'Changing password failed!';
                $alertText = 'Passwords do not match. Please try again.';
                $alertIcon = 'error';
            } else {
                if ($adminResult->num_rows > 0) {
                    // User is an admin, update password in admin_ebrgy table
                    $updateQuery = $conn->prepare("
                        UPDATE admin_ebrgy 
                        SET password = ?, updated_time = NOW() 
                        WHERE email = ?
                    ");
                } else {
                    // User is a regular user, update password in registereduser_ebrg table
                    $updateQuery = $conn->prepare("
                        UPDATE registereduser_ebrg 
                        SET password = ?, updated_time = NOW() 
                        WHERE email = ?
                    ");
                }
                $updateQuery->bind_param("ss", $new_password, $email);
                $updateQuery->execute();

                if ($updateQuery->affected_rows > 0) {
                    // Password was successfully updated
                    $alertTitle = 'Password update successful!';
                    $alertText = 'Click OK to go to the login page.';
                    $alertIcon = 'success';
                    $redirectUrl = 'index.php';
                } else {
                    $alertTitle = 'Password update failed!';
                    $alertText = 'Something went wrong. Please try again.';
                    $alertIcon = 'error';
                }
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



<script>
    const newPasswordInput = document.getElementById("new-password");
    const confirmPasswordInput = document.getElementById("confirm-password");
    const updateButton = document.querySelector(".update-button");
    const feedback = document.getElementById("password-feedback");
    const confirmFeedback = document.getElementById("confirm-password-feedback");

    // Validation function for new password
    function validateNewPassword() {
        const password = newPasswordInput.value;
        const rules = [
            { regex: /.{8,}/, message: "At least 8 characters long" },
            { regex: /[A-Z]/, message: "At least one uppercase letter" },
            { regex: /[a-z]/, message: "At least one lowercase letter" },
            { regex: /\d/, message: "At least one number" },
        ];

        const failedRules = rules.filter(rule => !rule.regex.test(password));
        if (failedRules.length > 0) {
            feedback.textContent = "Password must: " + failedRules.map(rule => rule.message).join(", ");
            feedback.style.color = "red";
            feedback.style.display = "block";
            return false;
        } else {
            feedback.textContent = "Password is strong!";
            feedback.style.color = "#98e4a3";
            feedback.style.display = "block";
            return true;
        }
    }

    // Validation function for confirm password
    function validateConfirmPassword() {
        const password = newPasswordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (password !== confirmPassword) {
            confirmFeedback.textContent = "Passwords do not match!";
            confirmFeedback.style.color = "red";
            confirmFeedback.style.display = "block";
            return false;
        } else {
            confirmFeedback.textContent = "Passwords match!";
            confirmFeedback.style.color = "#98e4a3";
            confirmFeedback.style.display = "block";
            return true;
        }
    }

    // Update the button state (enable/disable) based on validations
    function updateButtonState() {
        const isPasswordValid = validateNewPassword();
        const isConfirmPasswordValid = validateConfirmPassword();

        updateButton.disabled = !(isPasswordValid && isConfirmPasswordValid);
    }

    // Event listeners for input fields
    newPasswordInput.addEventListener("input", updateButtonState);
    confirmPasswordInput.addEventListener("input", updateButtonState);

    // Toggle password visibility function
    function togglePasswordVisibility(inputId, toggleIcon) {
        const passwordInput = document.getElementById(inputId);

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.textContent = "🙈";
        } else {
            passwordInput.type = "password";
            toggleIcon.textContent = "👁️";
        }
    }
</script>

</body>
</html>

