<?php
require 'connectdb.php';

if (isset($_POST["publish"])) {
    $title = $_POST["title"];
    $caption = $_POST["captions"];
    $selectedTable = $_POST["updates"]; // 'announcement' or 'event'

    //use to check and sure that the user input a minimun characters on each text area
    $mintitle_Length = 10;
    $mincaption_Length =100;

   
    // Check for minimum lengths
    if (strlen($title) < $mintitle_Length) {
        echo "<script>alert('Title must be at least $mintitle_Length characters long.');
          window.history.back();
          </script>";

    } elseif (strlen($caption) < $mincaption_Length) {
        echo "<script>alert('Caption must be at least $mincaption_Length characters long.');
          window.history.back();
          </script>";
    } else {
        // Check if image is uploaded
        if ($_FILES["image"]["error"] == 4) {
            echo "<script>alert('Image Does Not Exist');</script>";
        } else {
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];

            // Validate image extension and size
            $validImageExtensions = ['jpg', 'jpeg', 'png'];
            $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!in_array($imageExtension, $validImageExtensions)) {
                echo "<script>alert('Invalid Image Extension');</script>";
            } else if ($fileSize > 1000000) {
                echo "<script>alert('Image Size Is Too Large');</script>";
            } else {
                // Create unique image name and save to folder
                $newImageName = uniqid() . '.' . $imageExtension;
                move_uploaded_file($tmpName, 'uploads/' . $newImageName);

                // Choose table based on dropdown selection and save data
                if ($selectedTable == 'announcement') {
                    $query = "INSERT INTO brgy_announcement (announcement_title, announcement_img, announcement_content) 
                              VALUES ('$title', '$newImageName', '$caption')";
                } else {
                    $query = "INSERT INTO brgy_event (brgyevent_title, brgy_img, bgry_content) 
                              VALUES ('$title', '$newImageName', '$caption')";
                }

                if (mysqli_query($conn, $query)) {
                    echo "<script>alert('Successfully Added');</script>";
                } else {
                    echo "<script>alert('Error Adding Record');</script>";
                }
            }
        }
    }
}
?>
