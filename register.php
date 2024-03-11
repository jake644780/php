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
 
 <!--Porthub Premium -->
 <?php
 //require('connect.php');
 $conn = new mysqli("localhost", "root", "","3minusperfumes_forum");

 $username = @$_POST['username'];
 $email = @$_POST['email'];
 $password = @$_POST['password'];
 $repassword = @$_POST['repass'];
 
 //insert into
 $q = "insert into users(`id`, `username`, `password`, `email`) values ('','.$username.', '.$password.', '.$email.');";

if (isset($_POST['submit'])){
    if ($username && $password && $repassword && $email){

    }else{
        echo "please fill in the fields. <br>";
    }

    if ($conn->query($q)){
        echo "success";
    } else{
        echo "no success";
    }
}
 ?>