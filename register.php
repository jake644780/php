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

require("connect.php");

//variables
$username = @$_POST['username'];
$email = @$_POST['email'];
$password = @$_POST['password'];
$repassword = @$_POST['repassword'];
$date = date("Y-m-d");
$q = "insert into users(`id`, `username`, `password`, `email`, `date`) values ('','$username', '$password', '$email', '$date');";

if (isset($_POST['submit'])){
    if (!(empty($username) && empty($password) && empty($repassword) && empty($email))){
        if (strlen($username) >= 5 && strlen($username) < 25 && strlen($password) > 6){
            if ($repassword == $password){
                
                if ($conn->query($q)){
                    echo "you have registered as <b>$username</b>. <a href='login.php'>press here to login</a>";
                } else{
                    echo 'something went wrong <a href="emo.gif">saad</a>';
                }
            }else{
                echo "confirmation must patch password";
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
        echo 'please fill in the fields. <br><a href="emo.gif">saad</a>';
    }  
}
 ?>