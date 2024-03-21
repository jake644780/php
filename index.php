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
        <style>
        button {
            font-size: 1em;
            padding: 10px 20px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            box-shadow: 0 9px #999;
            transition: all 0.3s;
            margin-bottom: 50px;
        }

        button:hover {
            background-color: #0069D9;
        }

        button:active {
            background-color: #0062CC;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }
        table{
            border: gold 2px solid;
        }
        </style>
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
                        $edit_button = 0;
                        $tid = $row['topic_id'];
                        echo "<tr>";
                        echo "<td><a href='topic.php?id=$tid'>".$row['topic_id']."</td></a>";
                        echo "<td><a href='topic.php?id=$tid'>".$row['topic_name']."</td></a>";
                        $q11 = "select * from users where username='".$row['topic_creator']."'";
                        $result_2 = $conn->query($q11);
                        while ($rows = mysqli_fetch_assoc($result_2)){
                            $creator = $rows['id'];
                            if ($rows['username'] == $_SESSION['username']) $edit_button = 1;
                        }
                        if ($edit_button == 0) echo "<td><a href='profile.php?id=$creator'>".$row['topic_creator']."</td></a>";
                        else{
                                echo "<td><a href='index.php?id=".$row['topic_id']."&action=del'> you (DELETE) </td></a>";
                        }

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

    if (@$_GET['action'] == "del"){
        echo '<script type="text/javascript">
            var confirmBox = confirm("Are you sure you want to delete this topic?");
            if (confirmBox == true) {
                ';
                $q_del = "DELETE FROM topic WHERE topic_id='".$_GET['id']."'";
                $result_del = $conn->query($q_del);
                
                echo '
            } else {
                
            }
        </script>';
    }
?>

