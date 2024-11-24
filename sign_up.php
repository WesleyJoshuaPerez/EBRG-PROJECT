<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sign_up.css">
    <title>Sign Up</title>
    <link rel="shortcut icon" type="x-icon" href="logo/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@1..1000&display=swap" rel="stylesheet">
</head>

<body>
    <h3 class="title">Make new account</h3>

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
            <input type="date" class="bday" id="bday" name="birthday" placeholder="MM/DD/YYYY" required>
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

    <script src="sweetalert.js"></script>

    <?php
    include 'connectdb.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'mail/Exception.php';
    require 'mail/PHPMailer.php';
    require 'mail/SMTP.php';

    if (isset($_POST['sigUp'])) {
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmpassword'];
        // Check if password and confirm password match
        if ($password !== $confirmPassword) {
            echo "<script>swal('Error', 'Passwords do not match', 'error');</script>";
            exit();
        }
        // Check if the username already exists
        $checkUsername = "SELECT * FROM registereduser_ebrg WHERE username='$username'";
        $result = $conn->query($checkUsername);
        if ($result->num_rows > 0) {
            echo "<script>
                 swal('Something went wrong', 'Username Already Exists', 'error');
              </script>";
            exit();
        }

        // Check if the email already exists
        $checkEmail = "SELECT * FROM registereduser_ebrg WHERE email='$email'";
        $resultEmail = $conn->query($checkEmail);
        if ($resultEmail->num_rows > 0) {
            echo "<script>
                 swal('Something went wrong', 'Email Already Exists', 'error');
              </script>";
            exit();
        }

        $checkQuery = "SELECT * FROM registereduser_ebrg 
    WHERE firstname='$firstName' AND lastname='$lastName' 
    AND birthday='$birthday'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            // Update the username, password, and email for the matched record
            $updateQuery = "UPDATE registereduser_ebrg 
         SET username = '$username', 
             password = '$password', 
             email = '$email'
         WHERE firstname = '$firstName' 
           AND lastname = '$lastName' 
           AND birthday = '$birthday'";
            if ($conn->query($updateQuery) === TRUE) {
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'noreplyebrgy@gmail.com';
                    $mail->Password = 'evhbvnikpnwbhdlj';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom('noreplyebrgy@gmail.com', 'EBRGY');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Your EBRGY Account Created and Updated';
                    $mail->Body    = "Hello $firstName,<br><br>Your account has been created and updated:<br>Username: $username<br>Password: (hidden for security reasons)<br><br>Thank you,<br>EBRGY Team";

                    $mail->send();
                    echo "<script>
                    swal({
                        title: 'Update and Creation Successful',
                        text: 'Username and password updated. Notification sent.',
                        icon: 'success'
                    }).then(function() {
                        window.location.href = 'index.php';
                    });
                </script>";
                } catch (Exception $e) {
                    echo "<script>
                swal('Update Successful', 'But unable to send email notification.', 'warning');
                </script>";
                }
            } else {
                echo "<script>swal('Update Failed!', 'Please try again later.', 'error');</script>";
            }
        } else {
            echo "<script>swal('Error', 'User does not exist. Cannot register.', 'error');</script>";
        }
    }
    ?>
    <script>
        // disable previous dates
        document.addEventListener("DOMContentLoaded", function() {
            const absenceDateField = document.getElementById("bday");
            if (absenceDateField) {
                const today = new Date();
                const formattedDate = today.toISOString().split("T")[0]; // Format as yyyy-mm-dd
                absenceDateField.setAttribute("max", formattedDate); // Set minimum date to today
                console.log("Max date set for absence_date:", formattedDate);
            } else {
                console.error("Element with ID 'absence_date' not found.");
            }
        });
    </script>
</body>

</html>