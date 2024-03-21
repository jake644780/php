<?php
    session_start();
    require('connect.php');
    if (@$_SESSION["username"]){
    } else{
        echo 'you must be logged in....<br><a href="login.php">login here</a> or <a href="register.php">register</a>';
    }

    $master_id = isset($_GET['master_id']);
    echo $master_id;
?>

<html>
    <head>
        <title>3MinusPerfumes_Forum</title>
    </head>
        <?php include("header.php"); ?>
    <body>
        <div class="content">
            
        <?php 
        $q9 = "select * from topic where topic_id='".$_GET['id']."'";
        if($_GET['id']){
            $result = $conn->query($q9);
            if (mysqli_num_rows($result)){
                while ($row = mysqli_fetch_assoc($result)){
                    $by_me = 0;
                    $q10 = "select * from users where username='".$row['topic_creator']."'";
                    $result2 = $conn->query($q10);
                    while ($row2 = mysqli_fetch_assoc($result2)) $user_id = $row2['id'];
                    echo "<h1>".$row['topic_name']."</h1><br>";
                    if ($_SESSION['username'] == $row['topic_creator']) echo "<h5> készítette: <a href='profile.php?id=".$user_id."'><i>Me</i></a></h5><br><br>";
                    else 
                    echo "<h5> By: <a href='profile.php?id=".$user_id."'><i>".$row['topic_creator']."</i></a></h5><br><br>";
                    echo "<h2>Description</h2>";
                    echo "<p>".$row['description']."</p>";
                }
            } else echo "topic not found";
        } else echo "topic not found";

         echo '<table border="20px" style="border: 10px;">'?>
                <tr>
                    <th style="width: 50px;">
                         <span>ID</span>
                    </th>
                    <th style="width: 400px;">
                        Name
                    </th>
                    <th style="width: 80px;">
                        Creator
                    </th>
                    <th style="width: 100px;">
                        Date
                    </th>
                </tr>
                <br>
                <?php
                echo '<br><a href="post_post.php?master_id='.$_GET['id'].'"><button>Post post</button></a>';
                echo '<br><a href="index.php"><button>Go back</button></a>';
                
                $q8 = "SELECT * FROM posts WHERE master_id='".$_GET['id']."'";
                $result = $conn->query($q8);
                if (mysqli_num_rows($result) != 0) {
                    while($row = mysqli_fetch_assoc($result)){
                        $edit_button = 0;
                        $pid = $row['post_id'];
                        echo "<tr>";
                        echo "<td><a href='post.php?id=$pid'>".$row['post_id']."</td></a>";
                        echo "<td><a href='post.php?id=$pid'>".$row['post_name']."</td></a>";
                        $q11 = "select * from users where username='".$row['post_creator']."'";
                        $result_2 = $conn->query($q11);
                        while ($rows = mysqli_fetch_assoc($result_2)){
                            $creator = $rows['id'];
                            if ($rows['username'] == $_SESSION['username']) $edit_button = 1;
                        }
                        if ($edit_button == 0) echo "<td><a href='profile.php?id=$creator'>".$row['post_creator']."</td></a>";
                        else{
                                echo "<td><a href='post.php?id=".$row['post_id']."'> you (EDIT)</td></a>";
                        }

                        echo "<td><a href='post.php?id=$pid'>".$row['date']."</td></a>";
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