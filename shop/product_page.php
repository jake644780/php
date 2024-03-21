<?php
// Adatbázis kapcsolat létrehozása
$servername = "localhost"; // Adatbázis szerver neve vagy IP-címe
$username = "om"; // Adatbázis felhasználói név
$password = "om"; // Adatbázis jelszó
$dbname = "webshop"; // Adatbázis neve

// Kapcsolat létrehozása
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}

// Ha azonosító GET kérés érkezik
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // SQL lekérdezés a termék adatainak lekérésére
    $sql = "SELECT *
            FROM products
            INNER JOIN productdata ON products.product_id = productdata.product_id
            WHERE products.product_id = $productId";

    echo $sql;

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // A termék adatainak kiírása
        while($row = $result->fetch_assoc()) {
            $name = $row["name"];
            $brand = $row["brand"];
            $size = $row["size"];
            $strength = $row["strength"];
            $price = $row["price"];
            $stock = $row["stock"];
            $desc_short = $row["desc_short"];
            $desc = $row["description"];
            $flavor_table = $row["flavor_table"];
            $img1 = $row["image1"];
            $img2 = $row["image2"];
            $gender = $row["gender"];
        }
    } else {
        echo "A termék nem található.";
    }

    if ($gender == "male") {
      $gender_fake = "férfi";
    } else {
      $gender_fake = "női";
    }

} else {
    echo "Nincs megadva azonosító a termék lekéréséhez.";
}

// Kapcsolat bezárása
$conn->close();
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
<script src="shopSystem.js"></script>


  <title>3minus Webshop</title>
</head>

<body>

  <div>
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
                  <a class="nav-link"  href="index.php">Kezdőlap</a>
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
            </div>
          </div>
        </nav>
      </div>
    </div>

    <section>
      <div class="content-area">
        <div class="content-area-inner">
            <div class="row pr-display">
                <div class = "product-imgs col-lg-6">
                  <div class = "img-display">
                    <div class = "img-showcase">
                      <img src = "<?php
                        echo $img1;
                      ?>" alt = "termékkép" class="primg">
                      <img src = "<?php
                        echo $img2;
                      ?>" alt = "termékkép" class="primg">
                    </div>
                  </div>
                  <div class = "img-select">
                    <div class = "img-item">
                      <a href = "#" data-id = "1">
                        <img src = "<?php
                        echo $img1;
                      ?>" alt = "termékkép" class="primg primg-small">
                      </a>
                    </div>
                    <div class = "img-item">
                      <a href = "#" data-id = "2">
                        <img src = "<?php
                        echo $img2;
                      ?>" alt = "termékkép" class="primg primg-small">
                      </a>
                    </div>
                  </div>
                </div>
                <!-- card right -->
                <div class = "product-content col-lg-6">
                  <h3 class="product-brand"><?php
                    echo $brand;
                    ?></h3>
                  <h2 class = "product-title">
                    <?php
                    echo $name;
                    ?>
                  </h2>
                  <p class="product-size"><?php
                    echo $size;
                    ?></p>
                  <a href = "#" class = "product-link"><?php
                    echo $strength;
                    ?></a>
                  <a href = "#" class = "product-link"><?php
                    echo $gender_fake;
                    ?></a>
                  <p class="product-price"><?php
                    echo $price;
                    ?> Ft</p>
                  <div class = "purchase-info">


                    <?php
                    if ($stock > 5) {
                        echo "<div class='state instock'><i class='fa-solid fa-truck'></i><span> Raktáron</span></div>";
                        echo "<input type = 'number' min = '1' value = '1' max='$stock' id='addcount'>
                        <button class = 'cartbtn-main' onclick='addToCartBulk($productId)'>Kosárba</button>";
                    } elseif ($stock > 0) {
                        echo "<div class='state lowstock'><i class='fa-solid fa-boxes-stacked'></i></i><span> Utolsó darabok</span></div>";
                        echo "<input type = 'number' min = '1' value = '1' max='$stock' id='addcount'>
                        <button class = 'cartbtn-main' onclick='addToCartBulk($productId)'>Kosárba</button>";
                    } else {
                        echo "<div class='state nostock'><i class='fa-solid fa-x'></i><span> Nincs raktáron</span></div>";
                    }
                    ?>

                    
                  </div>
                  
                  <div class = "product-detail">
                    <p>
                        <?php
                            echo $desc_short;
                        ?>
                    </p>
                  </div>
                </div>
          <div class="pr-desc">
            <h3>Leírás</h3>
            <?php
                echo $flavor_table;
                echo $desc;
            ?>
          </div>
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
  <script src="script_productpage.js"></script>

  <div id="snackbar">A termék a kosárba került!</div>
</body>


</html>
