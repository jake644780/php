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
        <link rel="stylesheet" href="style.css">
        <title>Home page</title>
    </head>
    <body>
    <?php include("header.php"); ?>
    </body>
</html>

<?php
if (@$_GET['action'] == 'logout'){
    session_destroy();
    header("location: login.php");
}
?>
<?php
require("connect.php");
$q = "select * from users";
echo "<div class='content'><h1>Members</h1>";
$result = $conn->query($q);

while ($row = mysqli_fetch_assoc($result)){
    $id = $row['id'];
    echo "<a href='profile.php?id=$id'>".$row['username']."</a><br>";
}

echo "<a href='index.php'><button class='thing'>PENISZ</button></a>";

echo "</div>";
?>
