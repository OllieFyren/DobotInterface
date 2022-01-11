<?php
require_once ('./dbConfig.php');

$robot_name = "";

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $code = trim($_POST["code"]);
    $sql = "SELECT * FROM Robots WHERE code = '$code'";
    $result = $conn->query($sql);
    if(mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            header("Location: ../controller.php");
            $_SESSION["robotName"] = $row["name"];
        };
    } else {
        header("Location: ../index.php");
    }
} else {
    header("Location: ../index.php");
}