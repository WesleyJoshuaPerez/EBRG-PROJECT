<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EBRGY LOGIN</title>
    <link rel="shortcut icon" type="x-icon" href="logo/logo.png">
    <link rel="stylesheet" href="login.css" />
    <!--font style links-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:ital,wght@0,1..1000;1,1..1000&display=swap" rel="stylesheet">
  </head>
  <body>   
      <!--Use for the logo of the webpage-->
      <div class="logo">
        <img src="logo/logo.png" alt="EBRGY logo" />
      </div>
         <!--use header of the webpage-->
    <div class="header">Let's be informed...</div>
   <!--Form tag use in action  to another php file-->
  <form method="post"> 
    <!--Container for the login -->
    <div class="container_1">
      <!--use for login-->
      <label for="username">Username</label>
      <input type="text" oninput="toUppercase(this)" placeholder="Enter your username" id="username" name="username" required>
      <label for="password">Password</label>
      <div class="password-container">
            <input type="password" class="input_field5" name="password" id="password" placeholder="Enter your password" required>
            <span class="toggle-password" onclick="togglePasswordVisibility('password', this)">👁️</span>
      </div>
      <p id="password-feedback" style="color: red; font-size: 14px; display: none; margin-top: 5px;"></p>
      <a href="maindashboard.html">
       <button type="submit" name="login" id="bt1">Login</button>
     </a>
    </form>
      <a href="resetmail.php">Forgot Password?</a>
      <button id="bt2"  onclick="location.href='sign_up.php';">Make new account</button>
   </div>


    <!--Container for the guestmode-->
    <div class="container_2">
        <h2>Just here for a quick look? Try...</h2>
        <button id="bt3" onclick="location.href='guest_dashboard.php';">Guest Mode</button>
    </div>

  <!--for alerts-->
  <script src="sweetalert.js"></script>

<!--Use  for php backend that get user information in the form and confirm is the data that inputed is on  the table for the user-->
<?php
include 'connectdb.php';
// For login
if (isset($_POST["login"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $password = md5($password); // Uncomment if passwords are hashed

    // Check admin table
    $adminSql = "SELECT * FROM admin_ebrgy WHERE username='$username' AND password='$password'";
    $adminResult = $conn->query($adminSql);

    if ($adminResult->num_rows > 0) {
        // Admin login
        $adminRow = $adminResult->fetch_assoc();
        session_start();
        $_SESSION['username'] = $adminRow['username'];

        echo "<script>
            swal({
                title: 'Admin Login Successful!',
                text: 'Welcome to the Admin Dashboard!',
                icon: 'success'
            }).then(function() {
                window.location.href = 'admin.php';
            });
        </script>";
    } else {
        // Check user table
        $userSql = "SELECT * FROM registereduser_ebrg WHERE username='$username' AND password='$password'";
        $userResult = $conn->query($userSql);

        if ($userResult->num_rows > 0) {
            // User login
            $userRow = $userResult->fetch_assoc();
            if ($userRow['account_status'] == 'Active') {
                session_start();
                $_SESSION['username'] = $userRow['username'];

                echo "<script>
                    swal({
                        title: 'User Login Successful!',
                        text: 'Welcome to the Main Dashboard!',
                        icon: 'success'
                    }).then(function() {
                        window.location.href = 'maindashboard.php';
                    });
                </script>";
            } else {
                echo "<script>
                    swal({
                        title: 'Account Inactive!',
                        text: 'Your account is inactive. Please contact support.',
                        icon: 'warning'
                    });
                </script>";
            }
        } else {
            // Login failed
            echo "<script>
                swal('Login Failed!', 'Invalid username or password. Please try again.', 'error');
            </script>";
        }
    }
}
?>

<!-- input field -->
<script>
        function toUppercase(input) {
            input.value = input.value.toUpperCase();
        }
</script>

<!-- show password -->
<script>
        function togglePasswordVisibility(inputId, toggleIcon) {
    const passwordInput = document.getElementById(inputId);

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.textContent = "🙈"; // Change icon to hide
    } else {
        passwordInput.type = "password";
        toggleIcon.textContent = "👁️"; // Change icon to show
    }
}
</script>

<!-- password validation use to dissable the login button if the password requirement lenght doesnt meet-->
<script>
    document.getElementById("password").addEventListener("input", function () {
        const password = this.value;
        const feedback = document.getElementById("password-feedback");
        const loginButton = document.getElementById("bt1");

        // Password rules
        const rules = [
            { regex: /.{8,}/, message: "At least 8 characters long" },
            { regex: /[A-Z]/, message: "At least one uppercase letter" },
            { regex: /[a-z]/, message: "At least one lowercase letter" },
            { regex: /\d/, message: "At least one number" },
        ];

        // Check which rules are not satisfied
        const failedRules = rules.filter(rule => !rule.regex.test(password));

        if (failedRules.length > 0) {
            feedback.textContent = "Password must: " + failedRules.map(rule => rule.message).join(", ");
            feedback.style.color = "red";
            feedback.style.display = "block";
            loginButton.disabled = true; // Disable the login button
        } else {
            feedback.textContent = "";
            feedback.style.display = "none";
            loginButton.disabled = false; // Enable the login button
        }
    });

    // Ensure the login button is disabled initially
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("bt1").disabled = true;
    });
</script>


  </body>
</html>
