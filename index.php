<?php
    session_start();
    require('connect.php');
    if (@$_SESSION["username"]){
        echo "welcome ".$_SESSION["username"];
    }else{
        echo 'you must be logged in....<br><a href="login.php">login here</a> or <a href="register.php">register</a>';
    }


?>

<html>
    <head>
        <title>Home page</title>
    </head>
    <body>
        <center>
            <div class="navbar">Home page | Posts | <a href="profile.php">profile</a> | webshop | <a href="index.php?action = logout">logout</a></div>
        </center>
    </body>
</html>

<?php
if (@$_GET['action'] == 'logout'){
    session_destroy();
    header("location: login.php");
} else {
    echo "you must be logged in...";
}

?>