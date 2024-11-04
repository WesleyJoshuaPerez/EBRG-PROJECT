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
</head>
<body>
    <div class="reset-password-container">
        <h1>Reset Password</h1>
        <div class="form-container">
            <form action="forgot_password_process.php" method="POST">
                <label for="email" class="email-label">Email Address</label>
                <input type="email" name="email" placeholder="Enter Email Address" class="email-input" required>
                <button type="submit" name="password_reset_link"  class="reset-button">Send Password Reset Link</button>
            </form>
        </div>
    </div>
</body>
</html>
