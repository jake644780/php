<?php
require('connect.php');
if ($_SESSION['username']){
?>

<html>
    <style>
    body {
        background-image: url("src/bg.png");
        min-height: 100vh;
        overflow-x: hidden;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    
    } 


    </style>


    <?php
    $q2 = "select * from users where username ='".$_SESSION['username']."'";
    $result = $conn->query($q2); 
    $rows = mysqli_num_rows($result); 
    while ($row = mysqli_fetch_assoc($result)) $id = $row['id'];
    ?>
    <section>
        <div class="row header">
          <div class="col-lg-3">
            <a href="index.php"><img src="../shop/src/logo.png" alt="" class="logo"></a>
          </div>
          <div class="col-lg-9 nav-center">
            <nav class="navbar navbar-expand-lg navbar-dark nav-design nav-custom">
              <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                  aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="../index.php" >Kezdőlap</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Rólunk</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="../shop">Webshop</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="../forum">Fórum</a>
                    </li>
                  </ul>
                  <ul class="navbar-nav ml-auto">
                  <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link" href="members.php" title="Tagok"><i class="fa-solid fa-users"></i></a>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                    <?php 
                        $username_current = $_SESSION['username']; 
                        echo "<a class='nav-link' href='profile.php?id=$id' title='Bejelentkezve mint $username_current'><i class='fa-solid fa-user'></i></a>"; 
                        ?>
                    </li>
                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link " href="index.php?action=logout" title="Kijelentkezés"><i class="fa-solid fa-right-from-bracket"></i></a>
                    </li>
                </ul>
                </div>
              </div>
            </nav>
          </div>
        </div>
    </section>
</div>
</html>

<?php
}else{ header('location:index.php');} 
?>