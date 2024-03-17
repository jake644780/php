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
    <body>
    <?php include("header.php"); ?> <div class="content">
        
            <form action='post.php' method='POST'>
                <br>Topic name: <br><input type="text" name="topic_name" style="width: 400px;"><br>
                <br>Content: <br><textarea name="con" cols="30" rows="10" placeholder="type something..."></textarea><br>
                <input type="submit" name="submit" value="Post" style="width: 300px;">
            </form>
    </div>
    </body>
</html>

<?php
if (isset($_POST['submit'])){
    $topic_name = @$_POST['topic_name'];
    $content = @$_POST['con'];
    $date = date("y-m-d");
    $q7 = "insert into posts (`topic_id`,`topic_name`,`topic_content`,`topic_creator`,`date`) values('','".$topic_name."','".$content."', '".$_SESSION['username']."', '".$date."')"; 
    if ($topic_name && $content){
        if (strlen($topic_name) > 6 && strlen($topic_name) < 70){
            // Check if topic name already exists
            $query = "SELECT * FROM posts WHERE topic_name = '$topic_name'";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                echo "Topic name already exists. Please choose a different name.";
            } else {
                $result = $conn->query($q7);
                if ($result){
                    echo "success";
                }
            }
        } else echo "name has to be atleast 6 chars long and less than 70";
    } else echo "please fill in all the fields";
}
?>
