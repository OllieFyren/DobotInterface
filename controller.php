<?php
$title = "Robot controller";
$addCSS = "controller";
$scripts = true;
include_once ("components/header.php");
$robotName = $_SESSION["robotName"];
if(isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
}

?>
<body>
<div class="header">
    <div class="nameContainer">
        <p>Du er forbundet til: <?php echo "$robotName"?></p>
    </div>
    <div class="loginContainer">
        <?php
        echo ( true == $_SESSION["loggedIn"] ) ? "<p>Du er logget ind som: $username</p>" : "<button class='btn btn-secondary' onclick=\"location.href='/DobotInterface/login.php'\">Log ind</button>";
        ?>
    </div>
</div>
<div class="body">
    <div class="controller">
        <div id="log_area"></div>
        <div class="xyContainer">
            <div class="xy">
                <button class="forwardButton xyButton btn holdButton" ontouchstart="dobotUI.setJogInstantCmd(1, 1);" ontouchend="dobotUI.setJogInstantCmd(1, 0);" ontouchcancel="dobotUI.setJogInstantCmd(1, 0);"><i class="fas fa-arrow-up"></i></button>
                <button class="leftButton xyButton btn holdButton" ontouchstart="dobotUI.setJogInstantCmd(3, 1);" ontouchend="dobotUI.setJogInstantCmd(3, 0);" ontouchcancel="dobotUI.setJogInstantCmd(3, 0);"><i class="fas fa-arrow-left"></i></button>
                <button class="rightButton xyButton btn holdButton" ontouchstart="dobotUI.setJogInstantCmd(4, 1);" ontouchend="dobotUI.setJogInstantCmd(4, 0);" ontouchcancel="dobotUI.setJogInstantCmd(4, 0);"><i class="fas fa-arrow-right"></i></button>
                <button class="backButton xyButton btn holdButton" ontouchstart="dobotUI.setJogInstantCmd(2, 1);" ontouchend="dobotUI.setJogInstantCmd(2, 0);" ontouchcancel="dobotUI.setJogInstantCmd(2, 0);"><i class="fas fa-arrow-down"></i></button>
            </div>
        </div>
        <div class="zContainer">
            <div class="z">
                <button class="upButton zButton btn btn-dark" ontouchstart="dobotUI.setJogInstantCmd(5, 1);" ontouchend="dobotUI.setJogInstantCmd(5, 0);" ontouchcancel="dobotUI.setJogInstantCmd(5, 0);"><p>Op +</p></button>
                <button class="downButton zButton btn btn-dark" ontouchstart="dobotUI.setJogInstantCmd(6, 1);" ontouchend="dobotUI.setJogInstantCmd(6, 0);" ontouchcancel="dobotUI.setJogInstantCmd(6, 0);"><p>Ned -</p></button>
                <button class="upButton zButton btn btn-dark" ontouchstart="dobotUI.setEndEffectorGrap();"><p>Grib fat</p></button>
                <button class="downButton zButton btn btn-dark" ontouchstart="dobotUI.stopEndEffectorGrap();"><p>Slip</p></button>
            </div>
        </div>

        <?php
        if ($_SESSION["loggedIn"] == true){
            include_once ("components/userController.php");
        } else {
            echo "<h2 class='loginMessage'>Log ind for at begynde at lave programmer</h2>";
            echo "</div>";
            echo "</div>";
        }
        ?>


<script>
    $(function() {
        /*init data*/
        dobotUI.init();
        /*init data end*/
    });
</script>
</body>
