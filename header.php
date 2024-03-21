<?php
require('connect.php');
if ($_SESSION['username']){
?>

<html>
    <style>

    *{
            box-sizing: border-box;
    }
    .content{
            margin: auto;
            width: 50%;
            text-align: center;
    }
    body {
        background-image: url("src/bg.png");
        min-height: 100vh;
        overflow-x: hidden;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        color: wheat;
    
    } 

    .prof_pic{
        border-radius: 50%;
        height: 500px;
        width: 500px;
        float: left;
        margin-right: 20px;
        width: 100px; /* Adjust as needed */
        height: auto; /* This will maintain the aspect ratio */
        object-fit: cover;
        margin-bottom: 50px;
    }

    h1{
        padding: 40px 40px;
        border: gold 5px solid;
        background-color: grey;
    }

    h1, h2{
        text-decoration: underline;
        font-style: italic;
        border-radius: 30px;
    }
    h2{
        text-align: left;
    }

    h5{
        font-size: larger;
        border-top: #666 3px dashed;
        text-align: left;
    }

    p{
        color: black;
        font-size: larger;
        border: #111 solid 5px;
        padding-left: auto;
        padding-right: auto;
        padding-top: none;
        padding-bottom: 200px;
        text-align: justify;
        clear: both;
        background-color: beige;
    }
    table{
            border-collapse: collapse;
            min-width: 1000px;
            margin: 25px 0;
            font-size: 1.9em;
            margin: auto;
            padding-right: 20px;
            border-radius: 10px ;
            overflow: hidden;
            text-align: center;
            text-shadow: 1px 1px 0.1em black;
        }
        tbody a:hover{
            color: wheat;
        }
        tbody tr{
            border-bottom: 1px solid #dddddd;
            
        }

        tbody tr:nth-of-type(even){
            background-color: white;
        }

        
        tbody tr:nth-of-type(odd){
            background-color: #111;
        }

        th{
            padding: 12px 15px;
        }

        th{
            background-color: beige;
            color: black;
        }

    button {
            font-size: 1em;
            padding: 10px 20px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            box-shadow: 0 9px #999;
            transition: all 0.3s;
            margin-bottom: 50px;
        }

        .righter{
            transform: translateX(30px);
        }

        button:hover {
            background-color: #0069D9;
        }

        button:active {
            background-color: #0062CC;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }

    a {
        text-decoration: none;
        color: gold;
    }

    textarea{
        width: 400px;
        height: 600px;
        color: black;
        resize: none;
    }

    .thing{
        width: 500px;
        height: 500px;
    }
    </style>


    <?php
    $q2 = "select * from users where username ='".$_SESSION['username']."'";
    $result = $conn->query($q2); 
    $rows = mysqli_num_rows($result); 
    while ($row = mysqli_fetch_assoc($result)) $id = $row['id'];
    ?>
<div class="navbar" style="margin: auto; width: 50%; text-align: center;">
    <a href="index.php">Home page</a> 
    | <a href="members.php">Members</a> 
    | <?php 
            echo "logged in as <a href='profile.php?id=$id'>"; 
            echo $_SESSION['username']; 
            echo "</a> |"; ?> 
    | <a href="https://www.youtube.com/watch?v=j5a0jTc9S10&ab_channel=YourUncleMoe">webshop</a> 
    | <a href="account.php">my account</a> 
    | <a href="index.php?action=logout">logout</a>
</div>
</html>

<?php
}else{ header('location:index.php');} 
?>