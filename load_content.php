

<?php
require 'connectdb.php';

// Fetch Announcements
$announcementQuery = "SELECT announcement_id, announcement_title, announcement_img, announcement_content FROM brgy_announcement";
$announcementResult = mysqli_query($conn, $announcementQuery);

// Fetch Events
$eventQuery = "SELECT brgyevent_id, brgyevent_title, brgy_img, bgry_content FROM brgy_event";
$eventResult = mysqli_query($conn, $eventQuery);

// HTML for announcements and events
while ($row = mysqli_fetch_assoc($announcementResult)) {
    echo '<div class="content1" id="announcement_' . $row['announcement_id'] . '">';
    echo '<label class="brgy_updates"><strong>Brgy Announcement</strong></label>';
    echo '<img src="uploads/' . $row['announcement_img'] . '" alt="Announcement Image" class="uploadimg">';
    echo '<p class="fortitle">' . $row['announcement_title'] . '</p>';
    echo '<p class="cp1">' . $row['announcement_content'] . '</p>';
    echo '</div>';
    
    // Add Edit Buttons
    echo '<div class="editbuttons">';
    echo '<button class="edit1" onclick="editPhoto(' . $row['announcement_id'] . ', \'announcement\')"><strong>Edit Photo</strong></button>';
    echo '<button class="edit_brgyupdates" onclick="editAnnouncement(' . $row['announcement_id'] . ')"><strong>Edit Information</strong></button>';
    echo '<button class="delete1" onclick="deleteAnnouncement(' . $row['announcement_id'] . ')"><strong>Delete</strong></button>';
    echo '</div>';
}

while ($row = mysqli_fetch_assoc($eventResult)) {
    echo '<div class="content1" id="event_' . $row['brgyevent_id'] . '">';
    echo '<label class="brgy_updates"><strong>Brgy Event</strong></label>';
    echo '<img src="uploads/' . $row['brgy_img'] . '" alt="Event Image" class="uploadimg">';
    echo '<p class="fortitle">' . $row['brgyevent_title'] . '</p>';
    echo '<p class="cp1">' . $row['bgry_content'] . '</p>';
    echo '</div>';
  
    // Add Edit Buttons
    echo '<div class="editbuttons">';
    echo '<button class="edit1" onclick="editPhoto(' . $row['brgyevent_id'] . ', \'event\')"><strong>Edit Photo</strong></button>';
    echo '<button class="edit_brgyupdates" onclick="editEvent(' . $row['brgyevent_id'] . ')"><strong>Edit Information</strong></button>';
    echo '<button class="delete1" onclick="deleteEvent(' . $row['brgyevent_id'] . ')"><strong>Delete</strong></button>';
    echo '</div>';
}
?>