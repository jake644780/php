<?php
    session_start();
    require('connect.php');
    if (@$_SESSION["username"]){
    } else{
        echo 'you must be logged in....<br><a href="login.php">login here</a> or <a href="register.php">register</a>';
    }
    
    /*$master_id = isset($_GET['master_id']);
    echo $master_id;
    */
    if (isset($_GET['master_id'])) {
        $master_id = $_GET['master_id'];
    } else {
        echo "something went wrong...";
    }
    

?>

<html>
    <head>
          <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="favicon.ico">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="styles/style.css">
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

<script src="https://kit.fontawesome.com/8cd5027783.js" crossorigin="anonymous"></script>
<script src="ui_homepage.js"></script>
        <title>Poszt írása | 3minus Forum</title>
    </head>
    <body>
    <?php 
     
    include("header.php"); ?> <div class="content">

    <div class="content-area-dark">
        <div class="container">
            <h4 class="forum-title">Poszt írása</h4>
            <div class="post-editor">
                <?php echo "<form action='post_post.php?master_id=$master_id' method='POST'>" ?>
                    <br>Poszt címe: <br><input type="text" name="post_name" placeholder="milyen oszkár" required><br>
                    <br>Szöveg: <br><textarea name="con" cols="30" rows="10" placeholder="aki a fa..." required></textarea><br>
                    <input type="submit" name="submit" value="Közzététel" class="forumbtn"><br><br><br>
                </form>
            </div>
        </div>
    </div>
    </body>
</html>

<?php

if (isset($_POST['submit'])){
    $post_name = @$_POST['post_name'];
    $content = @$_POST['con'];
    $date = date("y-m-d");
    //$master_id = @$_POST['master_id'];

     
    if ($post_name && $content){
        if (strlen($post_name) > 6 && strlen($post_name) < 70){
            // Check if topic name already exists
            $query = "SELECT * FROM posts WHERE post_name='$post_name'";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                echo "Ilyen című poszt már létezik. Adj neki valami mást!";
            } else {
                $result = $conn->query("INSERT INTO posts (`post_id`,`post_name`,`post_content`,`post_creator`,`date`,`master_id`) VALUES ('','".$post_name."','".$content."', '".$_SESSION['username']."', '".$date."', '".$master_id."')");
                if ($result){
                    echo "success";
                    

                }
            }
        } else echo "A címnek 6 és 70 karakter között kell lennie";
    } else echo "Töltsd ki az összes mezőt";
}
?>
