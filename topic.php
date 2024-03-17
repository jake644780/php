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
            
        <?php
        $q9 = "select * from topic where id='".$_GET['id']."'";
        if($_GET['id']){
            $result = $conn->query($q9);
            if (mysqli_num_rows($result)){
                while ($row = mysqli_fetch_assoc($result)){
                    $q10 = "select * from users where username='".$row['creator']."'";
                    $result2 = $conn->query($q10);
                    while ($row2 = mysqli_fetch_assoc($result2)){
                        $user_id = $row2['id'];
                    }
                    echo "<h1>".$row['name']."</h1><br>";
                    echo "<h5> By: <a href='profile.php?id=$user_id'><i>".$row['creator']."</i></a></h5><br><br>";
                    echo $row['description'];
                }
            } else echo "topic not found";

        }else{
            echo "topic not found";
        }
        ?>
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
                <br>
                <a href="post_topic.php"><button>Post topic</button></a>
            <?php
                $q8 = "select * from posts";
                $result = $conn->query($q8);
                if (mysqli_num_rows($result) != 0) {
                    while($row = mysqli_fetch_assoc($result)){
                        $tid = $row['topic_id'];
                        echo "<tr>";
                        echo "<td><a href='topic.php?id=$tid'>".$row['topic_id']."</td></a>";
                        echo "<td><a href='topic.php?id=$tid'>".$row['topic_name']."</td></a>";
                        $q11 = "select * from users where username='".$row['topic_creator']."'";
                        $result_2 = $conn->query($q11);
                        while ($rows = mysqli_fetch_assoc($result_2)){
                            $creator = $rows['id'];
                        }
                        echo "<td><a href='profile.php?id=$creator'>".$row['topic_creator']."</td></a>";
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