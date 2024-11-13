<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EBRGY LOGIN</title>
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
      <input type="text" placeholder="Enter your username" id="username" name="username" required>
      <label for="password">Password</label>
      <input type="password" placeholder="Enter your password" id="password" name="password"  required>
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
        <button id="bt3" onclick="location.href='maindashboard.html';">Guest Mode</button>
    </div>

  <!--for alerts-->
  <script src="sweetalert.js"></script>

<!--Use  for php backend that get user information in the form and confirm is the data that inputed is on  the table for the user-->
<?php    
include 'connectdb.php';
// For login
if(isset($_POST["login"])){
    $username = $_POST['username'];
    $password = $_POST['password'];
//    $password = md5($password);

    $sql = "SELECT * FROM registereduser_ebrg WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        echo "<script>
             swal({
            title: 'Login successful!',
            text: 'Welcome to the EBRGY!',
            icon: 'success'
        }).then(function() {
            window.location.href = 'maindashboard.html';
        });
              </script>";
        exit();
    } else {
        echo "<script>
                 swal('Login Failed!', 'Please try again', 'error');
              </script>";
    }
} 
?>
  </body>
</html>
