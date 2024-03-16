<?php
    session_start();
    require('connect.php');
    if (@$_SESSION["username"]){
    } else{
        echo 'you must be logged in....<br><a href="login.php">login here</a> or <a href="register.php">register</a>';
    }


?>

<html>
    <head>

        <title>3MinusPerfumes_Forum</title>
    </head>
    <body>
    
    <style>
        .content{
            margin: auto;
            width: 50%;
            text-align: center;
        }
        body {
    background-image: url("src/bg.png");

    /* Set a specific height */
    min-height: 100vh;
    overflow-x: hidden;

    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

    </style>
    <?php include("header.php"); ?>
    </body>
</html>

<?php
if (@$_GET['action'] == 'logout'){
    session_destroy();
    header("location: login.php");
}
?>