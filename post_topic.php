<?php
    session_start();
    require('connect.php');
    if (@$_SESSION["username"]){
    } else{
        echo 'Először jelentkezz be! <br><a href="login.php">Bejelentkezés</a> or <a href="register.php">Regisztráció</a>';
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


        <title>Téma létrehozása | 3minus Forum</title>
    </head>
    <body>
    <?php include("header.php"); ?> <div class="content">
        <div class="content-area-dark">
            <div class="container">
                <h4 class="forum-title">Téma létrehozása</h4>
                <div class="post-editor">
                    <form action='post_topic.php' method='POST'>
                        <br>Téma neve: <br><input type="text" name="topic_name" placeholder="Milyen feri?" required><br>
                        <br>Leírás: <br><textarea name="con" cols="30" rows="5" placeholder="aki a fa..." required></textarea><br>
                        <input type="submit" name="submit" value="Létrehozás" class="forumbtn">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
if (isset($_POST['submit'])){
    $topic_name = @$_POST['topic_name'];
    $content = @$_POST['con'];
    $date = date("y-m-d");

    $q7 = "insert into topic (`topic_id`,`topic_name`,`date`,`description`,`topic_creator`)  values('','".$topic_name."','".$date."','".$content."','".$_SESSION['username']."')"; 
    
    if ($topic_name && $content){
        if (strlen($topic_name) > 6 && strlen($topic_name) < 70){
            $query = "select * from topic where topic_name='".$topic_name."'";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                echo "Ilyen nevű téma már létezik. Kérünk válassz másikat!";
            } else {
                $result = $conn->query($q7);
                if ($result){
                    echo "Téma létrehozva!";
                    header("Location:index.php");
                }
            }
        } else echo "A téma nevének 6 és 70 karakter közöttinek kell lennie!";
    } else echo "Töltsd ki az összes mezőt!";
}
?>