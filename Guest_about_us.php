<?php
session_start(); // Start the session
include 'connectdb.php'; // Include database connection

// Redirect to login if no user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$username = $_SESSION['username']; // Retrieve the username from session

// Check if the user clicked "Delete Account"
if (isset($_GET['action']) && $_GET['action'] === 'delete_account') {
    $sql = "UPDATE registereduser_ebrg SET account_status='Inactive' WHERE username='$username'";
    if ($conn->query($sql) === TRUE) {
        // If account deactivation is successful
        $_SESSION['account_status_message'] = "success";
    } else {
        // If there's an error in the query
        $_SESSION['account_status_message'] = "error";
    }
    header("Location: about_us.php"); // Redirect back to avoid re-triggering the deletion
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="about_us.css" />
        <link rel="stylesheet" href="darkmode.css"/>
        <title>About Us</title>
        <link rel="shortcut icon" type="x-icon" href="logo/logo.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@1..1000&display=swap" rel="stylesheet">
     <!-- Use to inclue Google Translate API -->
     <script  type="text/javascript" src="languagetrans.js"></script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
 <!-- Include SweetAlert2 -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <header>
            <div class="hamburger" id="hamburger">
                &#9776; <!-- Unicode character for hamburger icon -->
            </div>
            <nav id="nav-menu" class="nav_menu">
                <ul>
                    <li><a href="Guest_vision.php">Vision</a></li>
                    <li><a href="Guest_mission.php">Mission</a></li>
                    <li><a href="guest_dashboard.php">Guest Mode</a></li>
                    <li><a href="#" id="darkModeLink">Dark Mode</a></li>
                    <li><a href="index.php">Back to Login</a></li>
                    <!--Use for language translation -->
                <div id="Langtrans">
                    <div id="google_translate_element" style="display: inline-block;"></div>
                  </div>
                </ul>
            </nav>
            <div class="nav_logo">
                <img src="logo/mainpage_logo.png" alt="EBRGY logo">
            </div>
        </header>

        <h1 class="aboutus">about us</h1>
        <div class="container">
            <img src="logo/aboutus_logo.png" alt="ABOUT US logo" class="img">
            <h4>informing residents <br> in the blink of an eye</h4>
            <p>We aim to provide the latest news, updates, schedules, and whatnot to the 
                residents of the humble Barangay 
                Roosevelt, Dinalupihan, Bataan in order to instill and even focus whose 
                purpose is to become an information hub exclusive for the ones residing in the community. </p>
        </div>
    
           <script src="darkmode.js"></script>
           <!-- Link to the JavaScript file for hamburger menu function -->
           <script src="hamburgermenu.js"></script>
    </body>
    <!-- SweetAlert2 Messages -->
<script>
<?php if (isset($_SESSION['account_status_message'])): ?>
    <?php if ($_SESSION['account_status_message'] === "success"): ?>
        Swal.fire({
            title: 'Account Deleted!',
            text: 'Your account has been successfully deactivated.',
            icon: 'success'
        }).then(() => {
            window.location.href = 'index.php'; // Redirect to login after success
        });
    <?php elseif ($_SESSION['account_status_message'] === "error"): ?>
        Swal.fire({
            title: 'Error!',
            text: 'Unable to deactivate your account. Please try again later.',
            icon: 'error'
        });
    <?php endif; ?>
    <?php unset($_SESSION['account_status_message']); // Clear the message after displaying ?>
<?php endif; ?>
</script>

<!-- JavaScript for Delete Confirmation -->
<script>
function confirmDelete(event) {
    event.preventDefault(); // Prevent the default link action
    Swal.fire({
        title: 'Are you sure?',
        text: 'This will deactivate your account!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href; // Proceed with the deletion
        }
    });
    return false; // Prevent immediate navigation
}

// Attach the confirmation handler
document.getElementById('changeaccount_status').addEventListener('click', confirmDelete);
</script>