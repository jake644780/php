<?php
require('connect.php');
$q = "select * from users where username ='".$_SESSION['username']."'";
if ($_SESSION['username']){
?>

<html>
    <?php
    $result = $conn->query($q); 
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