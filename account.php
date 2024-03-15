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
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <?php include("header.php"); ?>
    <body>
        <?php
            $result = $conn->query($q); 
            $rows = mysqli_num_rows($result); 
            while ($row = mysqli_fetch_assoc($result)) {
                $img = $row['profile_pic'];
                $username = $row['username'];
                $email = $row['email'];
                $date = $row['date'];
                $replies = $row['replies'];
                $score = $row['score'];
                $topics = $row['topics'];
            }
            
        ?><div class="content">
                    <?php echo "<img src='$img' width='70' height='70'>";?>
                    <b>Username:</b> <?php echo $username;?> <br>
                    <b>Email:</b> <?php echo $email;?><br>
                    <b>Date registered:</b> <?php echo $date;?><br>
                    <b>Replies:</b> <?php echo $replies;?><br>
                    <b>Score:</b> <?php echo $score;?><br>
                    <b>Topics: </b><?php echo $topics;?><br><br>
                    <a href="account.php?action=changepass">Change password</a>
        </div>
    </body>
</html>

<?php
if (@$_GET['action'] == 'logout'){
    session_destroy();
    header("location: login.php");
} else if (@$_GET['action'] == "changepass"){
    echo "<div class='content'><form action='account.php?action=cp' method='POST'>";
    echo "enter current password: <input type='text' name='pass'><br>";
    echo "enter new password: <input type='text' name='newpass'><br>";
    echo "confirm new password: <input type='text' name='repass'><br>";
    echo "<input type='submit' name='changepass'>";
    echo "</form></div>";
} if (isset($_POST['changepass'])) {
    $result = $conn->query($q); 
    $rows = mysqli_num_rows($result); 
    while ($row = mysqli_fetch_assoc($result)) echo "<div class='content'>".$row['password']."</div>";
}
?>