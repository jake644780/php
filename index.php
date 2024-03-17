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

        <title>3MinusPerfumes_Forum</title>
    </head>
    <?php include("header.php"); ?>
    <body>
        <div class="content">
            <a href="post_topic.php"><button>Post topic</button></a>
            <?php echo '<table border="20px" style="border: 10px;">'?>
                <tr>
                    <td>
                         <span>ID</span>
                    </td>
                    <td style="width: 400px;">
                        Name
                    </td>
                    <td style="width: 80px;">
                        Creator
                    </td>
                    <td style="width: 80px;">
                        Date
                    </td>
                </tr>
            <?php
                $q8 = "select * from topic";
                $result = $conn->query($q8);
                if (mysqli_num_rows($result) != 0) {
                    while($row = mysqli_fetch_assoc($result)){
                        $tid = $row['id'];
                        echo "<tr>";
                        echo "<td><a href='topic.php?id=$tid'>".$row['id']."</td></a>";
                        echo "<td><a href='topic.php?id=$tid'>".$row['name']."</td></a>";
                        $q11 = "select * from users where username='".$row['creator']."'";
                        $result_2 = $conn->query($q11);
                        while ($rows = mysqli_fetch_assoc($result_2)){
                            $creator = $rows['id'];
                        }
                        echo "<td><a href='profile.php?id=$creator'>".$row['creator']."</td></a>";
                        echo "<td><a href='topic.php?id=$tid'>".$row['date']."</td></a>";
                        echo "</tr>";
                    }
                } else echo " not found";
                echo"</table>";
            ?>
        </div>

     
    </body>
</html>

<?php
if (@$_GET['action'] == 'logout'){
    session_destroy();
    header("location: login.php");
}
?>