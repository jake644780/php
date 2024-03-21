<?php
ob_start();
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
        
        
        </style>
        <div class="content">
            <a href="post_topic.php"><button>Post topic</button></a>
            <?php echo '<table ">'?>
                <tr>
                    <th style="width: 50px;border-right: 3px solid black;">
                         <span>ID</span>
                    </th>
                    <th style="width: 400px;border-right: 3px solid black;">
                        Name
                    </th>
                    <th style="width: 100px;border-right: 3px solid black;">
                        Creator
                    </th>
                    <th style="width: 200px;">
                        Date
                    </th>
                </tr>
            <?php
                $q8 = "select * from topic";
                $result = $conn->query($q8);
                if (mysqli_num_rows($result) != 0) {
                    while($row = mysqli_fetch_assoc($result)){
                        $edit_button = 0;
                        $tid = $row['topic_id'];
                        echo "<tr>";
                        echo "<td style='width: 50px;border-right: 3px solid black;'><a href='topic.php?id=$tid'>".$row['topic_id']."</td></a>";
                        echo "<td style='border-right: 3px solid black;'><a href='topic.php?id=$tid'>".$row['topic_name']."</td></a>";
                        $q11 = "select * from users where username='".$row['topic_creator']."'";
                        $result_2 = $conn->query($q11);
                        while ($rows = mysqli_fetch_assoc($result_2)){
                            $creator = $rows['id'];
                            if ($rows['username'] == $_SESSION['username']) $edit_button = 1;
                        }
                        if ($edit_button == 0) echo "<td style='border-right: 3px solid black;'><a href='profile.php?id=$creator'>".$row['topic_creator']."</td></a>";
                        else{
                                echo "<td style='border-right: 3px solid black;'><a href='index.php?id=".$row['topic_id']."&action=del'> you (DELETE) </td></a>";
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
    exit;
}


    if (@$_GET['action'] == "del"){
        echo '<script type="text/javascript">
            var confirmBox = confirm("Are you sure you want to delete this topic?");
            if (confirmBox == true) {
                ';
                $q_del = "DELETE FROM topic WHERE topic_id='".$_GET['id']."'";
                $result_del = $conn->query($q_del);
                header("Location:index.php");
                echo '
            } else {
                
            }
        </script>';
    }
    ob_end_flush();
?>

