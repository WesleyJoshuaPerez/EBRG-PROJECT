<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="sign_up.css" />
        <title>Sign Up</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@1..1000&display=swap" rel="stylesheet">
    </head>
    <body>
       
            <h3 class="title">Make new account</h3>

         <!--Form tag use in action  to another php file-->
          <form method="post" action="">
          <div class="container1">
      <div class="one_row-con">
        <h6 class="fistnamelb">First name</h6>
        <h6 class="lastnamelb">Last name</h6>
      </div>
      <div class="one_row-con">
          <input type="text" class="input_field1" placeholder="Enter your first name" name="firstname" required>
          <input type="text" class="input_field2" placeholder="Enter your last name" name="lastname" required>
      </div>
      <h6 class="birthday">Birthday</h6>

      <input type="date" class="bday" name="birthday" placeholder="MM/DD/YYYY" required>
      <h6 class="sex">Sex</h6>
      <div class="gender-container">
    <label class="gender1">
        <input type="radio" name="gender" value="female" required> Female
    </label>
    <label class="gender2">
        <input type="radio" name="gender" value="male" required> Male
    </label>
    <label class="gender3">
        <input type="radio" name="gender" value="Not Specified" required> Not Specified
    </label>
</div>
      <label for="username">Username</label>
      <input type="text" class="input_field3" name="username" id="username" placeholder="Enter your username" required>
      <label for="email">Email</label>
      <input type="email" class="input_field4" name="email" id="email" placeholder="Enter your email address" required>
      <label for="password">Password</label>
      <input type="password" class="input_field5" name="password" id="password" placeholder="Create a strong password" required>
      <label for="confirmpassword">Confirm Password</label>
      <input type="password" class="input_field6" name="confirmpassword" id="confirmpassword" placeholder="Re-enter your password" required>
      <p> By clicking Sign Up, you agree to our <a href="index.html">Terms</a> and <a href="index.html">Privacy Policy</a>.</p>
      
      <button type="submit" name="sigUp">Sign Up</button>
      </div>
    </form>
        <!--for alerts-->
  <script src="sweetalert.js"></script>
<!--php use for inputing  user information into the tables in the database that handles the  user indentifications and it is use for phpmailer that notify the user when they are register in our app-->
<?php 
include 'connectdb.php';

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mail/Exception.php';
require 'mail/PHPMailer.php';
require 'mail/SMTP.php';

// For signup
if(isset($_POST['sigUp'])){
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    // Check if password and confirm password match
    if($password !== $confirmPassword) {
        echo "<script>
           swal('Error', 'Passwords do not match', 'error');
              </script>";
        exit();
    }
    
    // Check if the username already exists
    $checkUsername = "SELECT * FROM registereduser_ebrg WHERE username='$username'";
    $result = $conn->query($checkUsername);
    if($result->num_rows > 0){
        echo "<script>
                 swal('Something went wrong', 'Username Already Exists', 'error');
              </script>";
        exit();
    }

    // Check if the email already exists
    $checkEmail = "SELECT * FROM registereduser_ebrg WHERE email='$email'";
    $resultEmail = $conn->query($checkEmail);
    if($resultEmail->num_rows > 0){
        echo "<script>
                 swal('Something went wrong', 'Email Already Exists', 'error');
              </script>";
        exit();
    } 

    // If no issues, insert the new user data into the database
    $insertQuery = "INSERT INTO registereduser_ebrg(firstname, lastname, birthday, gender, username, email, password)
                    VALUES ('$firstName', '$lastName', '$birthday', '$gender', '$username', '$email', '$password')";
    if($conn->query($insertQuery) === TRUE){
        // Send Registration Confirmation Email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'noreplyebrgy@gmail.com'; // Your email
            $mail->Password = 'evhbvnikpnwbhdlj'; // Your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('noreplyebrgy@gmail.com', 'EBRGY');
            $mail->addAddress($email); // User email

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Welcome to EBRGY!';
            $mail->Body    = 'Thank you for registering at EBRGY. Your account has been created successfully. You can log in to your account here: <a href="http://localhost/EBRG-PROJECT/index.php">Login to EBRGY</a>';

            // Send email
            $mail->send();
            
            echo "<script>
            swal({
                title: 'Signup successful!',
                text: 'Welcome to the EBRGY! A confirmation email has been sent.',
                icon: 'success'
            }).then(function() {
                window.location.href = 'index.php';
            });
            </script>";
            exit();
        } catch (Exception $e) {
            echo "<script>
            swal('Error', 'Unable to send confirmation email. Please try again later.', 'error');
            </script>";
        }

    } else {
        echo "<script>
             swal('Signup Failed!', 'We could not complete your sign-up. Please try again later.', 'error');
          </script>";
    }
}
?>


    </body>
</html>
