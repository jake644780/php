<?php
    session_start();
    require('connect.php');
    if (@$_SESSION["username"]){} else{echo 'you must be logged in....<br><a href="login.php">login here</a> or <a href="register.php">register</a>';}
?>
<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link href="https://fonts.cdnfonts.com/css/florentia" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Noto+Sans+Indic+Siyaq+Numbers&family=Roboto+Slab:wght@300&display=swap"
    rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles/style.css">

<script src="https://kit.fontawesome.com/8cd5027783.js" crossorigin="anonymous"></script>
         
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
                    echo "<b>replies:</b> ".$row['replies']."<br>";
                    echo "<b>score:</b> ".$row['score']."<br>";
                    echo "<b>topics created:</b> ".$row['topics']."<br>";
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