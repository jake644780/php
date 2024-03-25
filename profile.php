<?php
    session_start();
    require('connect.php');
    if (@$_SESSION["username"]){} else{echo 'you must be logged in....<br><a href="login.php">login here</a> or <a href="register.php">register</a>';}
?>
<html>
    <head>
        <title>Profile page</title>    
    </head>
    <body>
    <?php include("header.php"); ?> 
    <div class="content">
        <?php
        $q3 = "select * from users where id='".$_GET['id']."'";
        if (@$_GET['id']){
            $result = $conn->query($q3);
            $rows = mysqli_num_rows($result);
            if (mysqli_num_rows($result) != 0){
                while ($row = mysqli_fetch_assoc($result)){
                    echo "<b><h1>".$row['username']."</h1></b><img src='".$row['profile_pic']."' width='500' height='500'><br>";
                    echo "<b>date registered:</b> ".$row['date']."<br>";
                    echo "<b>email:</b> ".$row['email']."<br>";
                   
                }
            } else{
                echo "couldn't find id";
            }
        }
        ?>
    </div>
    </body>
</html>

<?php
if (@$_GET['action'] == 'logout'){
    session_destroy();
    header("location: login.php");
}
?>