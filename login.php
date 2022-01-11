<?php

$title = "Bruger login";
$addCSS = "login";
$scripts = false;
include_once("components/header.php");
if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true){
    header("Location: ./controller.php");
}
if(isset($_SESSION["userCreated"]) && $_SESSION["userCreated"] == true){
    echo "<div class='alert alert-success'>Du har oprettet en bruger og kan nu logge ind</div>";
    $_SESSION["userCreated"] = false;
}
if(isset($_SESSION["errorMessage"]) && !empty($_SESSION["errorMessage"])){
    $message = $_SESSION["errorMessage"];
    echo "<div class='alert alert-primary'>$message</div>";
    $_SESSION["errorMessage"] = "";
}
?>
    <div class="loginContent">
        <div class="card-container">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <form action="./components/submitLogin.php" method="post">
                        <div class="form-group">
                            <label for="username">Brugernavn</label>
                            <input type="text" class="form-control" name="username" placeholder="Indtast brugernavn">
                        </div>
                        <div class="form-group">
                            <label for="password">Kodeord</label>
                            <input type="password" class="form-control" name="password" placeholder="Indtast kodeord">
                        </div>
                        <button type="submit" class="btn btn-primary">Log ind</button>
                    </form>
                </div>
            </div>
            <p>Har du ikke en bruger? <a href="./register.php">Opret bruger</a></p>
        </div>
    </div>
<?php
?>