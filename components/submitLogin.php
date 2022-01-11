<?php
require_once ('./dbConfig.php');

$username = "";
$password = "";
$username_err = "";
$password_err = "";
$login_err = "";

session_start();


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Indtast venligst dit brugernavn.";
    } else {
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Indtast venligst dit kodeord.";
    } else {
        $password = trim($_POST["password"]);
    }
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result) > 0) {
            while($row = $result->fetch_assoc()) {
                header("Location: ../controller.php");
                $_SESSION["loggedIn"] = true;
                $_SESSION["username"] = $row["username"];
                $_SESSION["userID"] = $row["id"];
            };
        } else {
            header("Location: ../login.php");
            $_SESSION["errorMessage"] = "Forkert brugernavn eller kodeord";
        }
    }
    elseif(!empty($username_err)){
        header("Location: ../login.php");
        $_SESSION["errorMessage"] = $username_err;
    }
    elseif(!empty($password_err)){
        header("Location: ../login.php");
        $_SESSION["errorMessage"] = $password_err;
    }
}