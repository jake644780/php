<?php
ob_start();
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
        
        $q9 = "select * from topic where topic_id='".$_GET['id']."'";
        if($_GET['id']){
            $result = $conn->query($q9);
            if (mysqli_num_rows($result)){
                while ($row = mysqli_fetch_assoc($result)){
                    $by_me = 0;
                    $q10 = "select * from users where username='".$row['topic_creator']."'";
                    $result2 = $conn->query($q10);
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        $user_id = $row2['id'];
                        $prof_picy= $row2['profile_pic'];
                    }
                    echo "<title>".$row['topic_name']." | 3minus Forum</title>";
                    echo "<div class='row'><div class='col-lg-10'><h4 class='forum-title'>".$row['topic_name']."</h4></div>";
                    echo "<div class='col-lg-2'><div class='profile-card'><a href='profile.php?id=".$user_id."'><img class='profilepic-small' src='".$prof_picy."' >";
                    if ($_SESSION['username'] == $row['topic_creator']) echo "<h5>Én </a></h5></div></div></div>";
                    else 
                    echo "<h5><a href='profile.php?id=".$user_id."'>".$row['topic_creator']." </a></h5></div></div></div>";
                    echo "<p class='topic-desc'><i class='fa-solid fa-calendar-days'></i> ".$row['date']."</p>";
                    echo "<p class='topic-desc'>".$row['description']."</p>";
                    echo '<div class="forum-top-container"><a href="index.php"><button class="backbtn"><i id="left" class="fa-solid  fas fa-angle-left"></i> </button></a>';
                    echo '<a href="post_post.php?master_id='.$_GET['id'].'"><button class="forumbtn btright"><i class="fa-solid fa-newspaper"></i> Poszt írása</button></a></div>';
                }
            } else echo "A téma nem található";
        } else echo "A téma nem található";

         echo '<table class="table-topic">'?>
                <tr>
                    <th style="width: 50px;">
                         <span>ID</span>
                    </th>
                    <th style="width: 400px;">
                        Poszt
                    </th>
                    <th style="width: 80px;">
                        Létrehozó
                    </th>
                    <th style="width: 100px;">
                        Létrehozás dátuma
                    </th>
                </tr>
                <br>
                <?php
                
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
                            $pp =  $rows['profile_pic'];
                        }
                        if ($edit_button == 0) echo "<td><a href='profile.php?id=$creator'><img src=".$pp." alt='Profilkép' class='profilepic-small'> ".$row['post_creator']."</td></a>";
                        else{
                                echo "<td>Én <a href='topic.php?id=".$row['post_id']."&action=del'>[<i class='fa-solid fa-trash'></i> TÖRLÉS]</td></a>";
                        }

                        echo "<td><a href='post.php?id=$pid'>".$row['date']."</td></a>";
                        echo "</tr>";
                    }
                } else echo " not found";
                echo"</table>";
            ?>
            </div>
        </div>

        <?php include("footer.php"); ?>
    </body>
</html>


<?php
if(@$_GET['action']=="del"){
  $confirm = isset($_GET['confirm']) ? $_GET['confirm'] : 'no';
  if($confirm == 'yes'){
    $q_del="DELETE FROM posts WHERE post_id='".$_GET['id']."'";
    $result_del=$conn->query($q_del);
    header("Location:index.php");
  } else {
    echo '<script type="text/javascript">
      var confirmBox = confirm("Are you sure you want to delete this topic?");
      if(confirmBox == true){
        window.location.href = "topic.php?id='.$_GET['id'].'&action=del&confirm=yes";
      }
    </script>';
  }
}

if (@$_GET['action'] == 'logout'){
    session_destroy();
    header("location: login.php");
}
ob_end_flush();

?>