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
        $q12 = "select * from posts where post_id='".$_GET['id']."'";
        if($_GET['id']){
            $result = $conn->query($q12);
            if (mysqli_num_rows($result)){
                while ($row = mysqli_fetch_assoc($result)){
                    $by_me = 0;
                    $q10 = "select * from users where username='".$row['post_creator']."'";
                    $result2 = $conn->query($q10);
                    while ($row2 = mysqli_fetch_assoc($result2)) $user_id = $row2['id'];
                    echo "<h1>".$row['post_name']."</h1><br>";
                    if ($_SESSION['username'] == $row['post_creator']) echo "<h5> By: <a href='profile.php?id=".$user_id."'><i>Me</i></a></h5><br><br>";
                    else 
                    echo "<h5> By: <a href='profile.php?id=".$user_id."'><i>".$row['post_creator']."</i></a></h5><br><br>";
                    echo $row['post_content'];
                }
            } else echo "topic not found";
        } else echo "topic not found";
                echo '<a href="index.php"><button>Go back</button></a>';
                echo '<a href="post.php?action=co&id='.$_GET['id'].'">create comment</a>';
                ?>
            <?php

                $q4 = "select * from users where username='".$_SESSION['username']."'";
                $resulty = $conn->query($q4);
                $rowss = mysqli_num_rows($resulty); 
                while ($rowsss = mysqli_fetch_assoc($resulty)) {
                    $com_id = $rowsss['id'];
                    $com_crea =  $rowsss['username'];
                }
                if (@$_GET['action'] == "co"){
                    echo '<div class="content">
                        <form action="post.php?action=co&id='.$_GET['id'].'" method="POST">';
                    echo "<input type='hidden' name='creator' value='".$_SESSION['username']."'>";
                    echo "<input type='hidden' name='com_id' value='".$com_id."'>";
                    echo "enter comment: <input type='text' name='co_cont'><br>";
                    echo "<input type='submit' name='submit_co' value='change'>";
                    echo "</form></div>";
                }
                $comment_value = @$_POST['co_cont'];
                $date = date('y-m-d');
                $q14 = "INSERT INTO comments (`comment_id`,`comment_content`,`comment_creator`,`master_id`,`date`) VALUES ('','".$comment_value."','".$com_crea."','".$_GET['id']."','".$date."')";
                if (!empty($comment_value)){
                    $result = $conn->query($q14);
                    echo "succcess";
                }
                echo '<table border="20px" style="border: 10px;">'?>
                <tr><td><span>ID</span></td><td style="width: 400px;">Comment</td><td style="width: 80px;">Creator</td><td style="width: 80px;">Date</td></tr>
                <br>

                <?php
               $q8 = "SELECT * FROM comments WHERE master_id='".$_GET['id']."'";
               $result = $conn->query($q8);
               if (mysqli_num_rows($result) != 0) {
                   while($row = mysqli_fetch_assoc($result)){
                       $edit_button = 0;
                       $pid = $row['comment_id'];
                       echo "<tr>";
                       echo "<td>".$row['comment_id']."</td>";
                       echo "<td>".$row['comment_content']."</td>";
                       $q11 = "select * from users where username='".$row['comment_creator']."'";
                       $result_2 = $conn->query($q11);
                       while ($rows = mysqli_fetch_assoc($result_2)){
                           $creator = $rows['id'];
                           if ($rows['username'] == $_SESSION['username']) $edit_button = 1;
                       }
                       if ($edit_button == 0) echo "<td><a href='profile.php?id=$creator'>".$row['comment_creator']."</td></a>";
                       else{
                               echo "<td><a href='post.php?id=".$row['comment_id']."'> you (EDIT)</td></a>";
                       }

                       echo "<td>".$row['date']."</td>";
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