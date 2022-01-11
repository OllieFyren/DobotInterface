<?php
require_once ('./dbConfig.php');
session_start();
$usernameSubmit = "";
$passwordSubmit = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $usernameErr = "Indtast venligst et brugernavn.";
    } else {
        $username = trim($_POST["username"]);
        $result = preg_match_all("/[a-z]/i", $username);
        $length = mb_strlen($username);
        if($result == $length && $length > 5 ){
            $usernameSubmit = $username;
        } else {
            $usernameErr = "Dit brugernavn kan kun indeholde bogstaverne A-Z og skal være mindst 6 karaktere langt.";
        }
    }
    if(empty(trim($_POST["password"]))){
        $passwordErr = "Indtast venligst et kodeord.";
    } else {
        $password = trim($_POST["password"]);
        $result = preg_match_all("/[a-z0-9]/i", $password);
        $length = mb_strlen($password);
        if($result == $length && $length > 5 ){
            $passwordSubmit = $password;
        } else {
            $passwordErr = "Dit kodeord kan kun indeholde bogstaverne A-Z og numrene 0-9, og skal være mindst 6 karaktere langt.";
        }
    }
    if(empty(trim($_POST["password2"]))){
        $passwordErr = "Gentag venligst dit kodeord.";
    } else {
        $password2 = trim($_POST["password2"]);
        $password = trim($_POST["password"]);
        if($password2 != $password ){
            $passwordErr = "Kodeordene er ikke ens.";
        }
    }
    if(empty($usernameErr) && empty($passwordErr)){
        $sql = "INSERT INTO users (username, password) VALUES ('$usernameSubmit', '$passwordSubmit')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION["userCreated"] = true;
            header("Location: ../login.php");
        } else {
            $_SESSION["registerErr"] = true;
            header("Location: ../register.php");
        }
    } elseif(!empty($usernameErr)){
        header("Location: ../register.php");
        $_SESSION["errorMessage"] = $usernameErr;
    }
    elseif(!empty($passwordErr)){
        header("Location: ../register.php");
        $_SESSION["errorMessage"] = $passwordErr;
    }
}