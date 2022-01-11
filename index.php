<?php

$title = "Forbind til robotten";
$addCSS = "front";
$scripts = false;
include_once("components/header.php");
$loggedIn = false;
?>
    <div class="body">
        <div class="index">
            <h2>Indtast kode</h2>
            <form action="components/checkCode.php" method="post">
                <div class="inputContainer">
                    <input class="codeInput" type="text" name="code">
                    <button class="codeConfirm btn btn-primary" type="submit">Fortsæt</button>
                </div>
            </form>
        </div>
    </div>
<?php
?>