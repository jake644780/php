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
    <?php 
     
    include("header.php"); ?> <div class="content">
        
            <form action='post_post.php' method='POST'>
                <br>Post name: <br><input type="text" name="post_name" style="width: 400px;"><br>
                <br>Content: <br><textarea name="con" cols="30" rows="10" placeholder="type something..."></textarea><br>
                <input type="submit" name="submit" value="Post" style="width: 300px;"><br><br><br>
                <input type="hidden" name="master_id" value="<?php echo $_GET['id']; ?>">
            </form>
    </div>
    </body>
</html>

<?php
if (isset($_POST['submit'])){
    $master__id = $_POST['master_id'];
    $post_name = @$_POST['post_name'];
    $content = @$_POST['con'];
    $date = date("y-m-d");

     
    if ($post_name && $content){
        if (strlen($post_name) > 6 && strlen($post_name) < 70){
            // Check if topic name already exists
            $query = "SELECT * FROM posts WHERE post_name='$post_name'";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                echo "Post with this name already exists. Please choose a different name.";
            } else {
                $result = $conn->query("INSERT INTO posts (`post_id`,`post_name`,`post_content`,`post_creator`,`date`,`master_id`) VALUES ('','".$post_name."','".$content."', '".$_SESSION['username']."', '".$date."', '".$master__id."')");
                if ($result){
                    echo "success";
                }
            }
        } else echo "name has to be atleast 6 chars long and less than 70";
    } else echo "please fill in all the fields";
}
?>
