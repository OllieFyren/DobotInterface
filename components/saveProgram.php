<?php
require_once ('./dbConfig.php');
session_start();
$user_id = $_SESSION["userID"];
$dataArray = $_POST['dataArray'];
$name = $_POST['name'];
$sql = "INSERT INTO programs (name, user_id) VALUES ('$name', '$user_id')";
if ($conn->query($sql) === TRUE) {
    $sql = "";
    foreach ($dataArray as $item) {
        if ($item[0] === "1") {
            $sql .= "INSERT INTO program_steps (type, x_coordinate, y_coordinate, z_coordinate, grip_status, program_id) VALUES (1, $item[1], $item[2], $item[3], 0, $conn->insert_id);";
        } else if ($item[0] === "0" && $item[1] === "1") {
            $sql .= "INSERT INTO program_steps (type, x_coordinate, y_coordinate, z_coordinate, grip_status, program_id) VALUES (0, 0, 0, 0, 1, $conn->insert_id);";
        } else {
            $sql .= "INSERT INTO program_steps (type, x_coordinate, y_coordinate, z_coordinate, grip_status, program_id) VALUES (0, 0, 0, 0, 0, $conn->insert_id);";
        }
    }
    if ($conn->multi_query($sql) === TRUE) {
        echo 'Program gemt';
    }
} else {
    echo 'Fejl';
}
