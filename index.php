<html>
    <body>
        
    </body>
</html>

<?php
    session_start();
    require('connect.php');
    if (@$_SESSION["username"]){
        echo "welcome ".$_SESSION["username"];
    }else{
        echo 'you must be logged in....<br><a href="login.php">login here</a> or <a href="register.php">register</a>';
    }

?>