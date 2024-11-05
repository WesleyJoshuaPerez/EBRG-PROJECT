<?php
if(isset($_SESSION['status']))
{	
	?>
		<div class="alert alert-success">
			<h5><h?= $_SESSION['status']; ?></h5>
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
    <link rel="stylesheet" href="styles-resetmail.css"> 
    <!-- Font style links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:ital,wght@0,1..1000;1,1..1000&display=swap" rel="stylesheet">
<!-- Include SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <div class="reset-password-container">
        <h1>Reset Password</h1>
        <div class="form-container">
            <form action="" method="POST">
                <label for="email" class="email-label">Email Address</label>
                <input type="email" name="email" placeholder="Enter Email Address" class="email-input" required>
                <button type="submit" name="password_reset_link"  class="reset-button">Send Password Reset Link</button>
            </form>
        </div>
    </div>
    
<!--Use for emailing the reset password link via phpmailer-->  
    <?php
if (isset($_POST['password_reset_link'])) {
    $email = $_POST['email'];
} else {
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mail/Exception.php';
require 'mail/PHPMailer.php';
require 'mail/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'noreplyebrgy@gmail.com';              
    $mail->Password   = 'evhbvnikpnwbhdlj';                    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
    $mail->Port       = 587;                                    

    // Recipients
    $mail->setFrom('noreplyebrgy@gmail.com', 'No-reply-ebrgy');
    $mail->addAddress($email);     

    $code = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'), 0, 10);

    // Content
    $mail->isHTML(true);                                  
    $mail->Subject = 'Password Reset';
    $mail->Body    = 'To reset your password go to this link right <a href="http://localhost/EBRG-PROJECT/changepass.php?code='.$code.'">here</a>. </br>Reset your password in a day.';

    // Establish database connection
    $conn = new mysqli('localhost', 'root', '', 'ebrgy');

    if ($conn->connect_error) {
        die('Could not connect to the database.');
    }

    // Prepare and execute email verification query
    $stmt = $conn->prepare("SELECT * FROM registereduser_ebrg WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email exists, update the reset code
        $codeQuery = $conn->prepare("UPDATE registereduser_ebrg SET code = ? WHERE email = ?");
        $codeQuery->bind_param("ss", $code, $email);
        $codeQuery->execute();
    
        // Send email
        $mail->send();
        $alertTitle = 'Email sending successful!';
        $alertText = 'Message has been sent, check your email';
        $redirectUrl = 'https://mail.google.com';

    } else {
        $alertTitle = 'Email Gather Failed!';
        $alertText = 'Email address not found';
        $redirectUrl = 'resetmail.php';
    }

    // Clean up
    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    $alertTitle = 'Email Sending Error!';
    $alertText = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    $redirectUrl = 'resetmail.php';
}

// Output SweetAlert2 script
echo "<script>
    Swal.fire({
        title: '$alertTitle',
        text: '$alertText',
        icon: '" . ($result->num_rows > 0 ? 'success' : 'error') . "'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '$redirectUrl';
        }
    });
</script>";
?>
</body>
</html>
