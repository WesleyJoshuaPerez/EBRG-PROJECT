<?php
require 'connectdb.php';

// Fetch Announcements
$announcementQuery = "SELECT announcement_id, announcement_title, announcement_img, announcement_content FROM brgy_announcement";
$announcementResult = mysqli_query($conn, $announcementQuery);

// HTML structure for each announcement
while ($row = mysqli_fetch_assoc($announcementResult)) {
    echo '<div class="announcement content1" id="announcement_' . $row['announcement_id'] . '" style="background-color: #9C905E; height: 350px; width: 770px; border-radius: 8px; margin-bottom: 20px; margin-top: 70px; margin-left: 400px; padding: 20px; box-sizing: border-box;">';
    echo '<label class="brgy_updates" style="background-color: #CCAE0E; padding: 5px 15px; border-radius: 8px; font-size: 19px; font-weight: bold; color: #ffffff; width: 200px top: 30px"><strong>Barangay Announcement</strong></label>';
    echo '<img src="uploads/' . $row['announcement_img'] . '" alt="Announcement Image" class="uploadimg" style="height: 300px; width: 240px; border-radius: 8px; float: left; margin-right: 30px; margin-left: 20px">';
    echo '<div style="margin-left: 260px;">'; // Wrapper for text content
    echo '<p class="fortitle" style="font-size: 23px; font-weight: bold; color: #ffffff; margin-bottom: 10px;">' . $row['announcement_title'] . '</p>';
    echo '<p class="cp1" style="font-size: 17px; color: #ffffff; line-height: 1.5;">' . $row['announcement_content'] . '</p>';
    echo '</div>';
    echo '</div>';
}

?>
