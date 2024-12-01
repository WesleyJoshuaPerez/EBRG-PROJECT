<?php
session_start(); // Start the session to use $_SESSION

// Import necessary PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mail/Exception.php';
require 'mail/PHPMailer.php';
require 'mail/SMTP.php';

if (isset($_SESSION['status'])) {
    ?>
    <div class="alert alert-success">
        <h5><?php echo $_SESSION['status']; ?></h5>
    </div>
    <?php
    unset($_SESSION['status']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="shortcut icon" type="x-icon" href="logo/logo.png">
    <link rel="stylesheet" href="styles-resetmail.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="reset-password-container">
        <h1>RESET PASSWORD</h1>
        <div class="form-container">
            <form action="" method="POST">
                <label for="email" class="email-label">Email Address</label>
                <input type="email" name="email" placeholder="Enter Email Address" class="email-input" required>
                <button type="submit" name="password_reset_link" class="reset-button">Send Password Reset Link</button>
            </form>
        </div>
    </div>

    <?php
   if (isset($_POST['password_reset_link'])) {
    $email = $_POST['email'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreplyebrgy@gmail.com';
        $mail->Password = 'evhbvnikpnwbhdlj';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('noreplyebrgy@gmail.com', 'No-reply-ebrgy');
        $mail->addAddress($email);

        // Generate a unique verification code
        $code = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'), 0, 10);

        // Establish database connection
        $conn = new mysqli('localhost', 'root', '', 'ebrgy');
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }

        // Check if email exists in registereduser_ebrg or admin_ebrgy table
        $userStmt = $conn->prepare("SELECT reguser_id FROM registereduser_ebrg WHERE email = ?");
        if ($userStmt) {
            $userStmt->bind_param("s", $email);
            $userStmt->execute();
            $userResult = $userStmt->get_result();

            $user_type = '';
            $user_id = null;

            if ($userResult->num_rows > 0) {
                // User email found
                $row = $userResult->fetch_assoc();
                $user_id = $row['reguser_id'];
                $user_type = 'user'; // Role is user
            } else {
                // Check if email exists in admin_ebrgy table
                $adminStmt = $conn->prepare("SELECT admin_id FROM admin_ebrgy WHERE email = ?");
                if ($adminStmt) {
                    $adminStmt->bind_param("s", $email);
                    $adminStmt->execute();
                    $adminResult = $adminStmt->get_result();

                    if ($adminResult->num_rows > 0) {
                        // Admin email found
                        $row = $adminResult->fetch_assoc();
                        $user_id = $row['admin_id'];
                        $user_type = 'admin'; // Role is admin
                    }
                    // Close admin statement
                    $adminStmt->close();
                }
            }

            if ($user_type) {
                // Insert data into resetpass_request table
                $request_date = date('Y-m-d H:i:s');
                $insertStmt = $conn->prepare("INSERT INTO resetpass_request (reset_token, email, request_date, user_type, user_id) VALUES (?, ?, ?, ?, ?)");
                if ($insertStmt) {
                    $insertStmt->bind_param("ssssi", $code, $email, $request_date, $user_type, $user_id);
                    $insertStmt->execute();

                    // Send email
                    $mail->isHTML(true);
                    $mail->Subject = $user_type == 'admin' ? 'Admin Password Reset' : 'User Password Reset';
                    $mail->Body = 'To reset your password, click this link: <a href="http://localhost/EBRG-PROJECT/changepass.php?code='.$code.'">Reset Password</a>.<br>This link will expire in 24 hours.';
                    $mail->send();

                    $alertTitle = 'Email Sent!';
                    $alertText = 'Password reset link sent to your email address.';
                    $redirectUrl = 'https://mail.google.com';
                }
                // Close insert statement
                $insertStmt->close();
            } else {
                $alertTitle = 'Email Not Found!';
                $alertText = 'The email address does not exist in our records.';
                $redirectUrl = 'resetmail.php';
            }

            // Close user statement
            $userStmt->close();
        }

        // Clean up
        $conn->close();
    } catch (Exception $e) {
        $alertTitle = 'Error!';
        $alertText = 'Could not send email. Error: ' . $mail->ErrorInfo;
        $redirectUrl = 'resetmail.php';
    }

    // Output SweetAlert2 script
    echo "<script>
        Swal.fire({
            title: '$alertTitle',
            text: '$alertText',
            icon: '" . ($user_type ? 'success' : 'error') . "' 
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '$redirectUrl';
            }
        });
    </script>";
}
    ?>
</body>
</html>
