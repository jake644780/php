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
    <?php include("header.php"); ?>
    <body>
        <div class="content">
            
        <?php
        $q9 = "select * from topics where topic_id='".$_GET['id']."'";
        if($_GET['id']){
            $result = $conn->query($q9);
            if (mysqli_num_rows($result)){
                while ($row = mysqli_fetch_assoc($result)){
                    $q10 = "select * from users where username='".$row['topic_creator']."'";
                    $result2 = $conn->query($q10);
                    while ($row2 = mysqli_fetch_assoc($result2)){
                        $user_id = $row2['id'];
                    }
                    echo "<h1>".$row['topic_name']."</h1><br>";
                    echo "<h5> By: <a href='profile.php?id=$user_id'><i>".$row['topic_creator']."</i></a></h5><br><br>";
                    echo $row['topic_content'];
                }
            } else echo "topic not found";

        }else{
            echo "topic not found";
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