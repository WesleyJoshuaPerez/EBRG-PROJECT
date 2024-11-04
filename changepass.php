<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="styles-changepass.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:ital,wght@0,1..1000;1,1..1000&display=swap" rel="stylesheet">
</head>
<body>
    <div class="change-password-container">
        <h1>Change Password</h1>
        <form action="change_password_process.php?code=<?php echo $_GET['code']; ?>" method="post">
            <!-- Hidden field for code -->
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
</body>
</html>