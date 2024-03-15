<?php
require('connect.php');
$q = "select * from users where username ='".$_SESSION['username']."'";
if ($_SESSION['username']){
?>

<html>
    <?php?>
<center><div class="navbar"><a href="index.php">Home page</a> | <a href="members.php">Members</a> | <?php echo 'Logged in as <a href="profile.php?id=">'; echo @$_SESSION["username"]." |"; $result = $conn->query($q); $rows = mysqli_num_rows($result); while ($row = mysqli_fetch_assoc($result)) echo $row['id'];?></a> | <a href="profile.php">my profile</a> | webshop | <a href="index.php?action=logout">logout</a></div></center>
</html>

<?php
}else{ header('location:index.php');} 
?>