<?php
require 'connectdb.php';

$response = ["success" => false];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT announcement_title, announcement_content FROM brgy_announcement WHERE announcement_id = $id";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $response["success"] = true;
        $response["announcement_title"] = $row['announcement_title'];
        $response["announcement_content"] = $row['announcement_content'];
    }
}

echo json_encode($response);
?>
