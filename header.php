<?php
require('connect.php');
if ($_SESSION['username']){
?>

<html>
    <style>
        .content{
            margin: auto;
            width: 50%;
            text-align: center;
        }
        body {
    background-image: url("src/bg.png");

    /* Set a specific height */
    min-height: 100vh;
    overflow-x: hidden;

    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    color: wheat;
    
} 

    a {
        text-decoration: none;
        color: gold;
    }

    </style>
    <?php
    $q2 = "select * from users where username ='".$_SESSION['username']."'";
    $result = $conn->query($q2); 
    $rows = mysqli_num_rows($result); 
    while ($row = mysqli_fetch_assoc($result)) $id = $row['id'];
    ?>
<div class="navbar" style="margin: auto; width: 50%; text-align: center;">
    <a href="index.php">Home page</a> 
    | <a href="members.php">Members</a> 
    | <?php 
            echo "logged in as <a href='profile.php?id=$id'>"; 
            echo $_SESSION['username']; 
            echo "</a> |"; ?> 
    | <a href="webshop.php">webshop</a> 
    | <a href="account.php">my account</a> 
    | <a href="index.php?action=logout">logout</a>
</div>
</html>

<?php
}else{ header('location:index.php');} 
?>