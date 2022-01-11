<?php
if($_SESSION["loggedIn"] == ""){
    echo "<button class='btn btn-secondary' onclick=\"location.href='/webshop/login.php'\">Log ind</button>";
}