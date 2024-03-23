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
        <title>Tagjaink | 3minus Forum</title>
    </head>
    <body>
    <?php include("header.php"); 
    

    ?>


    <div class="content-area-dark">
        <div class="container">
<?php
    if (@$_GET['action'] == 'logout'){
        session_destroy();
        header("location: login.php");
    }
    ?>
    <?php
    require("connect.php");
    $q = "select * from users";
    echo "<h4 class='forum-title'>Tagjaink</h4>";
    $result = $conn->query($q);
    echo "<ul class='members-list'>";
    while ($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        echo "<li><div class='profile-card pc-post'><h5><a href='profile.php?id=".$id."'><img class='profilepic-small' src='".$row["profile_pic"]."' >".$row["username"]."</a></h5></div></li>";
    }
    echo "</ul>";


    ?>
    </div>
    </div>
    <?php include("footer.php"); ?>
    </body>
</html>