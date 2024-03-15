<html>
<head><title>login please</title>
<link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <form action="login.php" method="POST">
        username: <input type="text" name="username"><br>
        password: <input type="text" name="password"><br>
        <input type="submit" name="submit" name="submit" value="login">
    </form>
</body>
</html>
<?php
session_start();
$username = @$_POST['username'];
$password = @$_POST['password'];
require("connect.php");

if (isset($_POST['submit'])){
    if (!empty($username) && $password){
        $check = "select * from users where username = '$username'";
        $result = $conn->query($check);
        $rows = mysqli_num_rows($result);
        if ($rows != 0 ){
            while ($row = mysqli_fetch_assoc($result)){
                $db_username = $row['username'];
                $db_password = $row['password'];
            }
            if ( $username == $db_username && $password == $db_password){
                echo "logged in";
                @$_SESSION["username"] = $username;
                header("Location: index.php");
            }
            else{
                echo "your password is wronk";
            }
        }else{
            echo "not found";
        }
    }else{
        echo "pease fill in all the fields";
    }
}
?>