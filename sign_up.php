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
          <input type="text" class="input_field1" placeholder="First name" name="firstname" required>
          <input type="text" class="input_field2" placeholder="Last name" name="lastname" required>
      </div>
      <h6 class="birthday">Birthday</h6>

      <input type="date" class="bday" name="birthday" required>
      <h6 class="gender">Gender</h6>
      <label class="gender1">
          <input type="radio" name="gender" value="female" required> Female
      </label>
      <label class="gender2">
          <input type="radio" name="gender" value="male" required> Male
      </label>
      <label class="gender3">
          <input type="radio" name="gender" value="custom" required> Custom
      </label>

      <input type="text" class="input_field3" name="username" id="username" placeholder="Username" required>
      <input type="email" class="input_field4" name="email" id="email" placeholder="Email" required>
      <input type="password" class="input_field5" name="password" id="password" placeholder="Password" required>
      <input type="password" class="input_field6" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required>
      <p> By clicking Sign Up, you agree to our <a href="index.html">Terms</a> and <a href="index.html">Privacy Policy</a>.</p>
      
      <button type="submit" name="sigUp">Sign Up</button>
      </div>
    </form>
        <!--for alerts-->
  <script src="sweetalert.js"></script>
<!--php use for inputing  user information into the tables in the database that handles the  user indentifications-->
<?php 
include 'connectdb.php';

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

    // Remove this line to stop encrypting the password
    // $password = md5($password); // Encrypt password

    // Check if the username already exists
    $checkUsername = "SELECT * FROM registereduser_ebrg WHERE username='$username'";
    $result = $conn->query($checkUsername);
    if($result->num_rows > 0){
        echo "<script>
                 swal('Something went wrong', 'Username Already Exists', 'error');
              </script>";
    } else {
        $insertQuery = "INSERT INTO registereduser_ebrg(firstname, lastname, birthday, gender, username, email, password)
                        VALUES ('$firstName', '$lastName', '$birthday', '$gender', '$username', '$email', '$password')";
        if($conn->query($insertQuery) === TRUE){
            echo "<script>
            swal({
           title: 'Signup successful!',
           text: 'Welcome to the EBRGY!',
           icon: 'success'
       }).then(function() {
           window.location.href = 'index.php';
       });
             </script>";
            exit();
        } else {
            echo "<script>
                 swal('Signup Failed!', 'We could not complete your sign-up. Please try again later.', 'error');
              </script>";
        }
    }
}
?>
    </body>
</html>
