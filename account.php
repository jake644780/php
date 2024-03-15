<?php
    session_start();
    require('connect.php');
    if (@$_SESSION["username"]){
    } else{
        echo 'you must be logged in....<br><a href="login.php">login here</a> or <a href="register.php">register</a>';
    }


?>

<html>
    <script>console.log("hello mom!");</script>
    <head>
        <title>Home page</title>
        
    </head>
    <?php include("header.php"); ?>
    <body>
        <?php
            $result = $conn->query($q); 
            $rows = mysqli_num_rows($result); 
            while ($row = mysqli_fetch_assoc($result)) {
                $username = $row['username'];
                $email = $row['email'];
                $date = $row['date'];
                $replies = $row['replies'];
                $score = $row['score'];
                $topics = $row['topics'];
            }
        ?>
            
                <b>Username:</b> <?php echo $username;?> <br>
                <b>Email:</b> <?php echo $email;?><br>
                <b>Date registered:</b> <?php echo $date;?><br>
                <b>Replies:</b> <?php echo $replies;?><br>
                <b>Score:</b> <?php echo $score;?><br>
                <b>Topics: </b><?php echo $topics;?><br>
    </body>
</html>

<?php
if (@$_GET['action'] == 'logout'){
    session_destroy();
    header("location: login.php");
}
?>