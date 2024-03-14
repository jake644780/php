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
        <title>Home page</title>
    </head>
    <body>
    <?php include("header.php"); 
    if (@$_GET['id']){
        $q = "select * from users where id='".$_GET['id']."'";
        $result = $conn->query($q);
        $rows = mysqli_num_rows($result);
        if (mysqli_num_rows($result) != 0){
            echo "success";
        } else{
            echo "couldn't find id";
        }
    }
    ?>
    </body>
</html>

<?php
if (@$_GET['action'] == 'logout'){
    session_destroy();
    header("location: login.php");
}
?>