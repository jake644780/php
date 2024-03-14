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
    echo "<center>";
    if (@$_GET['id']){
        $q = "select * from users where id='".$_GET['id']."'";
        $result = $conn->query($q);
        $rows = mysqli_num_rows($result);
        if (mysqli_num_rows($result) != 0){
            while ($row = mysqli_fetch_assoc($result)){
                echo "<h1>".$row['username']."</h1><br>";
                echo "date registered: ".$row['date']."<br>";
                echo "email: ".$row['email']."<br>";
                echo "replies: ".$row['replies']."<br>";
                echo "score: ".$row['score']."<br>";
                echo "topics created: ".$row['topics']."<br>";

            }
        } else{
            echo "couldn't find id";
        }
    }
    echo "</center>";
    ?>
    </body>
</html>

<?php
if (@$_GET['action'] == 'logout'){
    session_destroy();
    header("location: login.php");
}
?>