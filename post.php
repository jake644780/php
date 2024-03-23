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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link href="https://fonts.cdnfonts.com/css/florentia" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Noto+Sans+Indic+Siyaq+Numbers&family=Roboto+Slab:wght@300&display=swap"
    rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles/style.css">

<script src="https://kit.fontawesome.com/8cd5027783.js" crossorigin="anonymous"></script>
    </head>
        <?php include("header.php"); ?>
    <body>
        <div class="content-area-dark">
            <div class="container">       
        <?php  
        $q12 = "select * from posts where post_id='".$_GET['id']."'";
        if($_GET['id']){
            $result = $conn->query($q12);
            if (mysqli_num_rows($result)){
                while ($row = mysqli_fetch_assoc($result)){
                    $by_me = 0;
                    $q10 = "select * from users where username='".$row['post_creator']."'";
                    $result2 = $conn->query($q10);
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        $user_id = $row2['id'];
                        $pp = $row2['profile_pic'];
                    }
                    echo "<title>".$row['post_name']." | 3minus Forum</title>";
                    echo "<h4 class='forum-title'>".$row['post_name']."</h4>";
                    echo '<div class="forum-top-container"><a href="index.php"><button class="backbtn"><i id="left" class="fa-solid  fas fa-angle-left"></i> </button></a>';
                    echo '<a href="post.php?action=co&id='.$_GET['id'].'"><button class="forumbtn btright"><i class="fa-solid fa-comment"></i> Komment írása</button></a></div>';
                    echo "<div class='post-main'><p class='post-text'>" .$row['post_content']."</p><hr class='post-line'>";
                    if ($_SESSION['username'] == $row['post_creator']) echo "<div class='profile-card pc-post'><h5><a href='profile.php?id=".$user_id."'><img class='profilepic-small' src='".$pp."' >Én</a></h5></div></div>";
                    else 
                    echo "<div class='profile-card pc-post'><h5><a href='profile.php?id=".$user_id."'><img class='profilepic-small' src='".$pp."' >".$row['post_creator']."</a></h5></div>";
                    echo "<p class='post-date'><i class='fa-solid fa-calendar-days'></i> ".$row["date"]."</p></div>";
                }
            } else echo "A téma nem található";
        } else echo "A téma nem található";
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
                               echo "<td><a href='post.php?id=".$row['comment_id']."&action=del'> you (DELETE)</td></a>";
                       }

                       echo "<td>".$row['date']."</td>";
                       echo "</tr>";
                   }
               } else echo " not found";
               echo"</table>";
            ?>
        </div>
        </div>

     
    </body>
</html>

<?php

if (@$_GET['action'] == "del"){
    echo '<script type="text/javascript">
        var confirmBox = confirm("Are you sure you want to delete this topic?");
        if (confirmBox == true) {
            ';
            $q_del = "DELETE FROM comments WHERE comment_id='".$_GET['id']."'";
            $result_del = $conn->query($q_del);
            header("Location:index.php");
            echo '
        } else {
            
        }
    </script>';
}
if (@$_GET['action'] == 'logout'){
    session_destroy();
    header("location: login.php");
}
?>