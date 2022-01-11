<!DOCTYPE html >
<html>
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/DobotInterface/css/<?php echo $addCSS?>.css">
    <link rel="stylesheet" href="/DobotInterface/css/global.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4bfc17f257.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width" initial-scale=1>
    <?php
    if ($scripts == true) {
        echo "<script src=\"scripts/jquery-ui-1.11.4/jquery-ui.js\"></script>";
        echo "<script src=\"scripts/qwebchannel.js\"></script>";
        echo "<script src=\"scripts/dobot.js\"></script>";
        echo "<script src=\"scripts/dobotUI.js\"></script>";
        echo "<script src=\"scripts/program.js\"></script>";
    }
    ?>
</head>
<?php
session_start();
if(!isset($_SESSION["loggedIn"])){
    $_SESSION["loggedIn"] = "";
}

?>
