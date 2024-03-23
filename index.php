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
        <title>3minus Forum</title>
    </head>

    <body>
    <?php include("header.php"); ?>


            <div class="content-area-dark">
                <div class="container">
                    <div class="forum-top-container ">
                        <p>Bejelentkezve mint <strong><?php echo $_SESSION['username'] ?><strong>
                        <a href="post_topic.php"><button class="newtopic-btn forumbtn "><i class="fa-solid fa-plus"></i> Új téma létrehozása</button></a></p>
                    </div>
                    <?php echo '<table class="table-topic">'?>
                        <tr>
                            <th style="width: 50px;">
                             <span>ID</span>
                            </th>
                            <th style="width: 400px;">
                                Téma
                            </th>
                            <th style="width: 80px;">
                                Létrehozó
                            </th>
                            <th style="width: 100px;">
                                Létrehozás dátuma
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
                                echo "<td><a href='topic.php?id=$tid'>".$row['topic_id']."</td></a>";
                                echo "<td><a href='topic.php?id=$tid'>".$row['topic_name']."</td></a>";
                                $q11 = "select * from users where username='".$row['topic_creator']."'";
                                $result_2 = $conn->query($q11);
                                while ($rows = mysqli_fetch_assoc($result_2)){
                                    $creator = $rows['id'];
                                    if ($rows['username'] == $_SESSION['username']) $edit_button = 1;
                                    $pp =  $rows['profile_pic'];
                                }
                                if ($edit_button == 0) echo "<td><a href='profile.php?id=$creator'><img src=".$pp." alt='Profilkép' class='profilepic-small'>  ".$row['topic_creator']."</td></a>";
                                else{
                                        echo "<td> Te <a href='index.php?id=".$row['topic_id']."&action=del'>[<i class='fa-solid fa-trash'></i> TÖRLÉS]</a> </td>";
                                }
                                echo "<td><a href='topic.php?id=$tid'>".$row['date']."</td></a>";
                                echo "</tr>";
                            }
                        } else echo " not found";
                        echo"</table>";
                    ?>
                    <br><br><br><br><br><br><br><br><br><br>
                </div>
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

