<?php

$title = "Opret bruger";
$addCSS = "register";
$scripts = false;
include_once("components/header.php");
$loggedIn = false;
if($_SESSION["loggedIn"] == true){
    header("Location: ./controller.php");
    $_SESSION["loggedInErr"] = true;
}
if(isset($_SESSION["registerErr"]) && $_SESSION["registerErr"] = true){
    echo "<div class='alert alert-danger'>Der var en uventet fejl da du oprettede din bruger. Prøv venligst igen senere.</div>";
    $_SESSION["userCreated"] = false;
}
if(isset($_SESSION["errorMessage"]) && !empty($_SESSION["errorMessage"])){
    $message = $_SESSION["errorMessage"];
    echo "<div class='alert alert-danger'>$message</div>";
    $_SESSION["errorMessage"] = "";
}
?>
<div class="registerContent">
    <div class="card-container">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <form action="./components/registerUser.php" method="post">
                    <div class="form-group">
                        <label for="username">Brugernavn</label>
                        <input type="text" class="form-control" name="username" placeholder="Indtast brugernavn">
                    </div>
                    <div class="form-group">
                        <label for="password">Kodeord</label>
                        <input type="password" class="form-control" name="password" placeholder="Indtast kodeord">
                    </div>
                    <div class="form-group">
                        <label for="password2">Gentag kodeord</label>
                        <input type="password" class="form-control" name="password2" placeholder="Indtast kodeord igen">
                    </div>
                    <button type="submit" class="btn btn-primary submit">Tilmeld</button>
                </form>
            </div>
        </div>
        <p>Har du allerede en bruger? <a href="login.php">Log ind</a></p>
    </div>
</div>
