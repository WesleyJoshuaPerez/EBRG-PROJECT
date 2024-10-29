<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <link rel="stylesheet" href="admin.css" />
    <link rel="stylesheet" href="darkmode.css"/>
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- Font style links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:ital,wght@0,1..1000;1,1..1000&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<div>
    <header>
        <div class="hamburger" id="hamburger">
            &#9776; <!-- Unicode character for hamburger icon -->
        </div>
        <nav id="nav-menu" class="nav_menu">
            <ul>
                <li><a href="about_us.html">About us</a></li>
                <li><a href="#">Conducted Projects</a></li>
                <li><a href="vision.html">Vision</a></li>
                <li><a href="mission.html">Mission</a></li>
                <li><a href="#">Guest Mode</a></li>
                <li><a href="#" id="darkModeLink">Dark Mode</a></li>
                <li><a href="index.html">Log Out</a></li>
            </ul>
        </nav>
        <div class="nav_logo">
            <img src="logo/logo_dark.png" alt="EBRGY logo">
        </div>
        <div class="nav-right">
            <img src="logo/icon.jpg" alt="Profile Picture" class="profile-pic">
        </div>
    </header>
    <div class="stickycontainer" id="locktitle">
        <div class="locktitle">
            <h3>admin <br> istrator <br> page</h3>
            <a href="#locktitle" class="navigate"><button class="create"><strong>create</strong></button></a>
            <div class="separator"></div>
            <a href="#content1" class="navigate"><button class="manage"><strong>manage</strong></button></a>
        </div>
      <!--use for inserting data into table using form-->
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="input-file">
                <div class="select-bg">
                    <input type="file" id="image" name="image" required>
                    <label for="image" class="select" id="fileLabel">
                        <strong><i class="fas fa-upload"></i> &nbsp; Select a picture</strong>
                    </label>
                </div>
            </div>
            <div class="updates">
                <label for="updates">Barangay Updates:</label>
                <div class="select-wrapper">
                    <select name="updates" id="updates" required>
                        <option value="announcement">Announcement</option>
                        <option value="event">Event</option>
                    </select>
                </div>
            </div>
            <div class="title">
                <h4>Write a Title:</h4>
                <textarea class="txt2" name="title" placeholder="Title appears here..." required></textarea>
            </div>
            <div class="caption">
                <h4>Write a caption:</h4>
                <textarea class="txt3" name="captions" placeholder="Captions appear here..." required></textarea>
            </div>
            <button class="publish" type="submit" name="publish"><strong>Publish</strong></button>
        </form>

        <div class="content1" id="content1">
            <label class="brgy_updates"><strong>Brgy updates</strong></label>
            <img src="bg_img/sample_img.jpg" alt="sample_img" class="uploadimg">
            <p class="fortitle">This is for the ebrgy title</p>
            <p class="cp1">Lorem ipsum dolor sit amet, consectetur 
                adipiscing elit, sed do eiusmod tempor 
                incididunt ut labore et dolore magna 
                aliqua. Ut enim ad minim veniam, quis 
                nostrud exercitation ullamco laboris nisi ut 
                aliquip ex ea commodo consequat Duis 
                aute irure dolor in reprehenderit in 
                voluptate velit esse cillum dolore eu fugiat 
                nulla pariatur.
            </p>
            <button class="save">
                <i class="fa fa-check"></i>
            </button>
        </div>
        
        <div class="editbuttons">
            <button class="edit1"><strong>edit photo</strong></button>
            <button class="edit_brgyupdates"><strong>edit updates</strong></button>
            <button class="caption1"><strong>edit caption</strong></button>
            <button class="delete1"><strong>delete</strong></button>
        </div>
      <!--for darkmode feature-->
        <script src="darkmode.js"></script>
     <!--for navigation-->
        <script src="hamburgermenu.js"></script>
           <!--for alerts-->
        <script src="sweetalert.js"></script>
        
        <script>
            function updateLabelText() {
                const fileInput = document.getElementById('image');
                const label = document.getElementById('fileLabel');
                if (fileInput.files.length > 0) {
                    const fileName = fileInput.files[0].name;
                    label.innerHTML = `<strong><i class="fas fa-upload"></i> &nbsp; ${fileName}</strong>`;
                } else {
                    label.innerHTML = `<strong><i class="fas fa-upload"></i> &nbsp; Select a picture</strong>`;
                }
            }

            document.getElementById('image').addEventListener('change', updateLabelText);
        </script> 
<!--use for connecting into the database and inserting data into the specific tables for announcement and events-->
<?php
require 'connectdb.php';

if (isset($_POST["publish"])) {
    $title = $_POST["title"];
    $caption = $_POST["captions"];
    $selectedTable = $_POST["updates"];
    
    $mintitle_Length = 10;
    $mincaption_Length = 100;

    if (strlen($title) < $mintitle_Length) {
        echo "<script>swal('Error','Title must be at least $mintitle_Length characters long.', 'error');</script>";
    } elseif (strlen($caption) < $mincaption_Length) {
        echo "<script>swal('Error','Caption must be at least $mincaption_Length characters long.', 'error');</script>";
    } elseif ($_FILES["image"]["error"] == UPLOAD_ERR_NO_FILE) { // Check if no file was uploaded
        echo "<script>swal('Error','Please select an image to upload.', 'error');</script>";
    } else {
        // Continue processing the uploaded file
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];
        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtensions)) {
            echo "<script>swal('Error','Invalid Image Extension', 'error');</script>";
        } elseif ($fileSize > 3145728) {
            echo "<script>swal('Error','Image Size Is Too Large', 'error');</script>";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            move_uploaded_file($tmpName, 'uploads/' . $newImageName);

            $query = $selectedTable == 'announcement' 
                ? "INSERT INTO brgy_announcement (announcement_title, announcement_img, announcement_content) VALUES ('$title', '$newImageName', '$caption')"
                : "INSERT INTO brgy_event (brgyevent_title, brgy_img, bgry_content) VALUES ('$title', '$newImageName', '$caption')";

            if (mysqli_query($conn, $query)) {
                echo "<script>swal('Success','Successfully Added', 'success');</script>";
            } else {
                echo "<script>swal('Error','Error Adding Record', 'error');</script>";
            }
        }
    }
}
?>
</body>
</html>
