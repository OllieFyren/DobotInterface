<?php
require_once ('./dbConfig.php');
session_start();
$user_id = $_SESSION["userID"];

$sql = "SELECT * FROM programs WHERE user_id='$user_id'";
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