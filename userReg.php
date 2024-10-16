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
                alert('Passwords do not match');
                window.history.back(); // Use this to go back to the sign up page without reloading
              </script>";
        exit();
    }

    $password = md5($password); // Encrypt password

    // Check if the username already exists
    $checkUsername = "SELECT * FROM registereduser_ebrg WHERE username='$username'";
    $result = $conn->query($checkUsername);
    if($result->num_rows > 0){
        echo "<script>
                alert('Username Already Exists');
                window.history.back(); // Use this to go back to the sign up page without reloading
              </script>";
    } else {
        $insertQuery = "INSERT INTO registereduser_ebrg(firstname, lastname, birthday, gender, username, email, password)
                        VALUES ('$firstName', '$lastName', '$birthday', '$gender', '$username', '$email', '$password')";
        if($conn->query($insertQuery) === TRUE){
           echo "<script>
                alert('Signup Successful');
                window.location.href='index.html';
              </script>";
            exit();
        } else {
            echo "<script>alert('Error: " . $conn->error . "'); window.location.href='sign_up.html';</script>";
        }
    }
}

// For login
if(isset($_POST["login"])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = md5($password);

    $sql = "SELECT * FROM registereduser_ebrg WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        echo "<script>
                alert('Login Successful');
                window.location.href='maindashboard.html';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Incorrect Username or Password');
                window.history.back(); // Use this to go back to the login page without reloading
              </script>";
    }
} 
?>
