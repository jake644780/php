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
            $q4 = "select * from users where username='".$_SESSION['username']."'";
            $result = $conn->query($q4); 
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
    echo "enter current password: <input type='text' name='curr_pass'><br>";
    echo "enter new password: <input type='text' name='new_pass'><br>";
    echo "confirm new password: <input type='text' name='re_pass'><br>";
    echo "<input type='submit' name='change_pass' value='change'>";
    echo "</form></div>";
}

$cur_pass = @$_POST['curr_pass'];
$new_pass = @$_POST['new_pass'];
$re_pass = @$_POST['re_pass'];
$get_pass = null;
if (isset($_POST['change_pass'])) {
    $result = $conn->query($q4); 
    $rows = mysqli_num_rows($result); 
    while ($row = mysqli_fetch_assoc($result)) $get_pass = $row['password'];
} if ($cur_pass == $get_pass){
    if (strlen($new_pass) > 6){
        if ($re_pass == $new_pass){
            if ($q4 = $conn->query("update users set password='".$new_pass."' where username='".$_SESSION['username']."'")){
              echo  "password changed";  
            }
        } else{
            echo "new password do not match";
        }
    } else{
        echo "new password must be atleast 7 characters long";
    }
}
?>