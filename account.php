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
                $topics = $row['topics'];
            }
            
        ?><div class="content">
                    <?php echo "<img src='$img' width='70' height='70'>";?>
                    <b>Username:</b> <?php echo $username;?> <br>
                    <b>Email:</b> <?php echo $email;?><br>
                    <b>Date registered:</b> <?php echo $date;?><br>
                    <b>Topics: </b><?php echo $topics;?><br><br>
                    <a href="account.php?action=changepass">Change password</a><br><br>
                    <a href="account.php?action=ci">Change Profile pic</a>
        </div>
    </body>
</html>

<?php
//logging out / 
if (@$_GET['action'] == 'logout'){
    session_destroy();
    header("location: login.php");
} 
//changing password
if (@$_GET['action'] == "changepass"){
    echo "<div class='content'><form action='account.php?action=cp' method='POST'>";
    echo "enter current password: <input type='text' name='curr_pass'><br>";
    echo "enter new password: <input type='text' name='new_pass'><br>";
    echo "confirm new password: <input type='text' name='re_pass'><br>";
    echo "<input type='submit' name='change_pass' value='change'>";
    echo "</form></div>";
}

$curr_pass = @$_POST['curr_pass'];
$new_pass = @$_POST['new_pass'];
$re_pass = @$_POST['re_pass'];

$get_pass = null;
if (isset($_POST['change_pass'])) {
    $result = $conn->query($q4); 
    $rows = mysqli_num_rows($result); 
    while ($row = mysqli_fetch_assoc($result)) {
        $get_pass = $row['password'];
    }
    if ($curr_pass == $get_pass){
        if (strlen($new_pass) > 6){
            if ($re_pass == $new_pass){
                if ($q4 = $conn->query("update users set password='".$new_pass."' where username='".$_SESSION['username']."'")){
                    echo  "<div class='content'>password changed</div>";  
                }
            } else{
                echo "<div class='content'>new password do not match</div>";
            }
        } else{
            echo "<div class='content'>new password must be atleast 7 characters long</div>";
        }
    } else {
        echo "current password is incorrect";
    }
}
//changing profile pic
if (@$_GET['action'] == "ci"){
    echo "<form action='account.php?action=ci' method='POST' enctype='multipart/form-data'><br>";
    echo "<div class='content'>available file extension: <b>.PNG .JPEG .JPG</b><br><br>";
    echo "<input type='file' name='image'><br>";
    echo "<input type='submit' name='change_pic' value='change'></div>";
    echo "</form>";
    if (isset($_POST['change_pic'])){
        $images_up = null;
        $errors = array();
        
        $allowed_e = array('png','jpeg','jpg');
        $file_name = $_FILES['image']['name'];
        $file_e = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $file_s = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        
        $q5 = "select * from users where username='".@$_SESSION['username']."'";
        $q6 = "update users set profile_pic='".$images_up."' where username='".$_SESSION['username']."'";

        if (in_array($file_e, $allowed_e) === false) $errors[] = 'this file extension is not allowed.';    
        if ($file_s > 2097152) $erros[] = 'file must be under 2 mb';
        
        if (empty($erros)) {
            move_uploaded_file($file_tmp, 'images/'.$file_name);
            $images_up = 'images/'.$file_name;
            $q6 = "update users set profile_pic='".$images_up."' where username='".$_SESSION['username']."'";
            $result = $conn->query($q5);
            $rows = mysqli_num_rows($result);
            while ($row = mysqli_fetch_assoc($result)) $db_image =  $row['profile_pic'];
            if ($query = $conn->query($q6)) {
                echo "your image has been changed";
                header("Refresh:0");
            }
        } else{
            foreach($erros as $error){
                echo $error, "<br>";
            }
        }
    
    }
}
?>


