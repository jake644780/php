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
 $conn = new mysqli("localhost", "root", "","3minusperfumes_forum");

 $username = @$_POST['username'];
 $email = @$_POST['email'];
 $password = @$_POST['password'];
 $repassword = @$_POST['repass'];
 
 //insert into
 $q = "insert into users(`id`, `username`, `password`, `email`) values ('','.$username.', '.$password.', '.$email.');";

if (isset($_POST['submit'])){
    if (!(empty($username) && empty($password) && empty($repassword) && empty($email))){
        if (strlen($username) >= 5 && strlen($username) < 25 && strlen($password) > 6){
            if ($repassword == $password){
                echo "success";
            }
        }else {
            if (strlen($username) < 5 || strlen($username) > 25) {
                echo "Username must be between 5 and 25 chars<br>"; 
            }
            if (strlen($password) < 6) {
                echo "password must be atleast ∛216 chars long<br>"; 
            }
        }
        
    }else{
        echo "please fill in the fields. <br>";
    }
    /*
    if ($conn->query($q)){
        echo "success";
    } else{
        echo "no success";
    }*/
}
 ?>