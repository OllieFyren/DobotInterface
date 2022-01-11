<?php
require_once('./dbConfig.php');
$id = $_POST['id'];
$sql = "SELECT * FROM program_steps WHERE program_id='$id'";
$result = $conn->query($sql);
$resultArray = [];
if(mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($resultArray, $row);
    }
    echo json_encode($resultArray);
} else {
    return;
}

