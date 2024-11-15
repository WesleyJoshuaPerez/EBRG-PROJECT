<?php
require 'connectdb.php';

// Fetch Events
$eventQuery = "SELECT brgyevent_id, brgyevent_title, brgy_img, bgry_content FROM brgy_event";
$eventResult = mysqli_query($conn, $eventQuery);

while ($row = mysqli_fetch_assoc($eventResult)) {
    echo '<div class="content1 announcement" id="event_' . $row['brgyevent_id'] . '" style="background-color:  #64551A; height: 350px; width: 770px; border-radius: 8px; margin-bottom: 20px; margin-top: 70px; margin-left: 400px; padding: 20px; box-sizing: border-box;">';
    echo '<label class="brgy_updates" style="background-color: #CCAE0E; padding: 5px 15px; border-radius: 8px; font-size: 19px; font-weight: bold; color: #ffffff; width: 200px; top: 30px"><strong>Barangay Event</strong></label>';
    echo '<img src="uploads/' . $row['brgy_img'] . '" alt="Event Image" class="uploadimg" style="height: 300px; width: 240px; border-radius: 8px; float: left; margin-right: 30px; margin-left: 20px;">';
    echo '<div style="margin-left: 260px;">'; // Wrapper for text content
    echo '<p class="fortitle" style="font-size: 23px; font-weight: bold; color: #ffffff; margin-bottom: 10px;">' . $row['brgyevent_title'] . '</p>';
    echo '<p class="cp1" style="font-size: 17px; color: #ffffff; line-height: 1.5;">' . $row['bgry_content'] . '</p>';
    echo '</div>';
    echo '</div>';


}
?>