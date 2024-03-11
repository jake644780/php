<html>
<head>
    <title>3MinusPerfumes</title>
</head>
<body>
   <form action="register.php" method="POST">
       
       username: <input type="text" name="username"><br>
       email: <input type="text" name="email"><br>
       password: <input type="text" name="password"><br>
       password again: <input type="text" name="repassword"><br>
       <input type="submit" name="submit" name="submit" value="register"> or <a href="login.php">login</a>
   </form>
</body>
</html>
 <?php
 $username = @$_POST['username'];
 $email = @$_POST['email'];
 $password = @$_POST['password'];
 $repassword = @$_POST['repass'];
 
 if (isset($_POST['submit'])){
    echo "username: - ".$username; 
 }
 ?>