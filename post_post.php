<?php
    session_start();
    require('connect.php');
    if (@$_SESSION["username"]){
    } else{
        echo 'you must be logged in....<br><a href="login.php">login here</a> or <a href="register.php">register</a>';
    }
    
    if (isset($_GET['master_id'])) {
        $master_id = $_GET['master_id'];
        echo $master_id;
    }     

    

?>

<html>
    <head>
        <title>3MinusPerfumes_Forum</title>
    </head>
    <body>
    <?php 
     
    include("header.php"); ?> <div class="content">
        
            <form action='post_post.php' method='POST'>
                <br>Post name: <br><input type="text" name="post_name" style="width: 400px;"><br>
                <br>Content: <br><textarea name="con" cols="30" rows="10" placeholder="type something..."></textarea><br>
                <input type="submit" name="submit" value="Post" style="width: 300px;"><br><br><br>
                <?php 
                //echo "<input type='hidden' name='master_id' value='$master_id'>";
                ?>
                
            </form>
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
                echo "Post with this name already exists. Please choose a different name.";
            } else {
                $result = $conn->query("INSERT INTO posts (`post_id`,`post_name`,`post_content`,`post_creator`,`date`,`master_id`) VALUES ('','".$post_name."','".$content."', '".$_SESSION['username']."', '".$date."', '".$master_id."')");
                if ($result){
                    echo "success";
                }
            }
        } else echo "name has to be atleast 6 chars long and less than 70";
    } else echo "please fill in all the fields";
}
?>
