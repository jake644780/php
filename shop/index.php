<?php
// Adatbázis kapcsolat beállítása (módosítsd az adatokat a saját adatbázisodhoz)
$servername = "localhost";
$username = "om";
$password = "om";
$dbname = "webshop";

$conn = new mysqli($servername, $username, $password, $dbname);


// Ellenőrizd a kapcsolatot
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products WHERE originalprice != 0";
$sql2 = "SELECT * FROM products WHERE brand='3minus'";
$sql3 = "SELECT * FROM products";


$result = $conn->query($sql);
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
?>
<!doctype html>
<html lang="hu">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="favicon.ico">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="style.css">
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

  <title>3minus Webshop</title>
</head>

<body>


    <div class="row header">
      <div class="col-lg-3">
        <a href="index.php"><img src="src/logo.png" alt="" class="logo"></a>
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
                  <a class="nav-link active" aria-current="page" href="#">Kezdőlap</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="products.php?ptype=parfum">Parfümök</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="products.php?ptype=parfumolaj">Parfümolajok</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="products.php?ptype=szett">Szettek</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="products.php?ptype=minta">Minták</a>
                </li>
              </ul>

              <ul class="navbar-nav ml-auto">

                <li class="nav-item me-3 me-lg-0">
                  <div class="search-container">
                    <form action="products.php" method="get">
                      <input class="search expandright" id="searchright" type="search" name="search" placeholder="Keresés...">
                      <label class="button searchbutton" for="searchright"><i class="fa-solid fa-magnifying-glass"></i></label>
                    </form>
                  </div>
                </li>

                <li class="nav-item me-3 me-lg-0">
                    <a class="nav-link text-white" href="cart.html"><i class="fas fa-shopping-cart navcart"></i></a>
                </li>
            </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>

    

    <section class="parallax">
      <div class="row slider">
        <div class="col-lg-6 side1">
          <img src="src/ad1.png" alt="" width="500px" class="floatFromLeft">
        </div>
        <div class="col-lg-6 side2">
          <div class="side2-inner">
            <h2 id="text1" class="floatFromBottom">Érezd a különbséget</h2>
            <p id="text2" class="floatFromBottom">Új Versace kollekció most 15% kedvezménnyel</p>
            <div class="button-container">
              <button class="borderbtn" id="button1">Tovább</button>
            </div>
          </div>

        </div>
      </div>
      <img src="src/overlay.png" alt="" id="overlay">
    </section>
    <section class="section-main">
      <div class="section-dark">
        <h3 class="section-title-light">Akciós termékek</h3>
        <div class="wrapper"> 
        <i id="left" class="fa-solid  fas fa-angle-left"></i> 
        <ul class="carousel"> 
        <?php
              // Ellenőrizd az eredményeket
    if ($result->num_rows > 0) {
        // Az árparaméter alapján szűrt termékek megjelenítése kártyák formájában
        while($row = $result->fetch_assoc()) {
          echo "<li class='card'>";
            if ($row["originalprice"] == 0) {
              echo '<div class="product-card">';
            }
            else {
              echo '<div class="product-card sale" data-label="AKCIÓ!">';
            }
            echo '<a href="product_page.php?id=' . $row["product_id"] .'"><div class="pr-img-container"><img src="' . $row["thumbnail"] . '" alt="' . $row["name"] . '"></div></a>';
            echo '<p class="pr-brand-name">'. $row["brand"] .'</p>';
            echo '<div class="pr-text-container"><a href="product_page.php?id=' . $row["product_id"] .'"><h3>' . $row["name"] . '</h3></a></div>';
            if ($row["originalprice"] == 0) {
              echo '<div class="pr-button-container"><div class="pricebox"><p class="currentprice">' . $row["price"] . ' Ft</p></div>';
            }
            else {
              echo '<div class="pr-button-container "><div class="pricebox"><div><p class="originalprice">' . $row["originalprice"] . ' Ft</p><p class="currentprice">' . $row["price"] . ' Ft</p></div></div>';
            }
            echo '<div class="buttonbox"><button class="cartbtn" onclick="addToCart(' . $row["product_id"] . ', 1)">Kosárba</button></div></div>';
            echo '</div></li>';
        }
    } else {
        echo "<p class='message'>Nem található a paramétereknek megfelelő termék.</p>";
    }?>
        </ul> 
        <i id="right" class="fa-solid fas fa-angle-right"></i> 
    </div> 
      </div>
    </section>

    <section class="section-main">
      <div class="section-blur">
        <div class="wrapper">
          <div class="row">
            <div class="col-lg-5"><img src="src/ad2.png" alt="" id="img-splash"></div>
            <div class="col-lg-7">
              <h3 class="section-title-main">Kirobbanó frissesség</h3>
              <h4 class="section-title-secondary">3minus Jedlik Collection</h4>
              <div id="showcase-jedlik">
                <ul class="carousel2">
              <?php
              // Ellenőrizd az eredményeket
    if ($result2->num_rows > 0) {
        // Az árparaméter alapján szűrt termékek megjelenítése kártyák formájában
        while($row = $result2->fetch_assoc()) {
          echo "<li class='card'>";
            if ($row["originalprice"] == 0) {
              echo '<div class="product-card">';
            }
            else {
              echo '<div class="product-card sale" data-label="AKCIÓ!">';
            }
            echo '<a href="product_page.php?id=' . $row["product_id"] .'"><div class="pr-img-container"><img src="' . $row["thumbnail"] . '" alt="' . $row["name"] . '"></div></a>';
            echo '<p class="pr-brand-name">'. $row["brand"] .'</p>';
            echo '<div class="pr-text-container"><a href="product_page.php?id=' . $row["product_id"] .'"><h3>' . $row["name"] . '</h3></a></div>';
            if ($row["originalprice"] == 0) {
              echo '<div class="pr-button-container"><div class="pricebox"><p class="currentprice">' . $row["price"] . ' Ft</p></div>';
            }
            else {
              echo '<div class="pr-button-container "><div class="pricebox"><div><p class="originalprice">' . $row["originalprice"] . ' Ft</p><p class="currentprice">' . $row["price"] . ' Ft</p></div></div>';
            }
            echo '<div class="buttonbox"><button class="cartbtn" onclick="addToCart(' . $row["product_id"] . ', 1)">Kosárba</button></div></div>';
            echo '</div></li>';
        }
    } else {
        echo "<p class='message'>Nem található a paramétereknek megfelelő termék.</p>";
    }?>
              </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-main">
      <div class="section-dark">
        <h3 class="section-title-light">Neked Ajánljuk</h3>
        <div class="wrapper"> 
        <i id="left" class="fa-solid  fas fa-angle-left"></i> 
        <ul class="carousel"> 
        <?php
              // Ellenőrizd az eredményeket
    if ($result3->num_rows > 0) {
        // Az árparaméter alapján szűrt termékek megjelenítése kártyák formájában
        while($row = $result3->fetch_assoc()) {
          echo "<li class='card'>";
            if ($row["originalprice"] == 0) {
              echo '<div class="product-card">';
            }
            else {
              echo '<div class="product-card sale" data-label="AKCIÓ!">';
            }
            echo '<a href="product_page.php?id=' . $row["product_id"] .'"><div class="pr-img-container"><img src="' . $row["thumbnail"] . '" alt="' . $row["name"] . '"></div></a>';
            echo '<p class="pr-brand-name">'. $row["brand"] .'</p>';
            echo '<div class="pr-text-container"><a href="product_page.php?id=' . $row["product_id"] .'"><h3>' . $row["name"] . '</h3></a></div>';
            if ($row["originalprice"] == 0) {
              echo '<div class="pr-button-container"><div class="pricebox"><p class="currentprice">' . $row["price"] . ' Ft</p></div>';
            }
            else {
              echo '<div class="pr-button-container "><div class="pricebox"><div><p class="originalprice">' . $row["originalprice"] . ' Ft</p><p class="currentprice">' . $row["price"] . ' Ft</p></div></div>';
            }
            echo '<div class="buttonbox"><button class="cartbtn" onclick="addToCart(' . $row["product_id"] . ', 1)">Kosárba</button></div></div>';
            echo '</div></li>';
        }
    } else {
        echo "<p class='message'>Nem található a paramétereknek megfelelő termék.</p>";
    }?>
        </ul> 
        <i id="right" class="fa-solid fas fa-angle-right"></i> 
    </div> 
      </div>
    </section>

    <div class="footer">
      <div class="row">
        <div class="col-lg-6 ">
        <img src="src/logo-footer.png" alt="" class="logo-footer">
          <div class="footer-pbox">
            <p>3minus Perfumes Kft.<br>9025 Győr, Vörös utca 19.<br>3minus.perfumes@gmail.com<br>+36301234567</p>
          </div>

        </div>
        <div class="col-lg-6">
            <ul class="footer-list">
              <li><a href="">Általános felhasználási feltételek</a></li>
              <li><a href="">Adatkezelési tájékoztató</a></li>
              <li><a href="">Szállítási információk</a></li>
              <li><a href="">Cookiek (sütik) használatának szabályzata</a></li>
            </ul>
        </div>
      </div>
    </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

    
</body>



</html>