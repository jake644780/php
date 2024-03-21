<?php
$servername = "localhost";
$username = "om";
$password = "om";
$dbname = "webshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sqlSel = "SELECT MAX(product_id) AS last_id FROM products";
$result = $conn->query($sqlSel);
$row = $result->fetch_assoc();
// Get the last inserted product ID
$targetid = $row["last_id"] + 1;



$target_dir = "img/";

$name = $_POST['name'];
$description = $_POST['description'];
$desc_short = $_POST['desc_short'];
$fej = $_POST['fej'];
$sziv = $_POST['sziv'];
$alap = $_POST['alap'];
$size = $_POST['size'];
$stock = $_POST['stock'];
$price = $_POST['price'];
$gender = $_POST['gender'];
$brand = $_POST['brand'];
$strength = $_POST['strength'];
$ptype = $_POST['ptype'];
$originalprice = $_POST['originalprice'];

$brand_friendly = str_replace(' ', '_', $brand);
$searchname = $brand . " " . $name;


$flavor_table = '<table class="table table-pr">
<tbody><tr>
  <td>Fej</td>
  <td>'. $fej . '</td>
</tr>
<tr>
  <td>Szív</td>
  <td>' . $sziv . '</td>
</tr>
<tr>
  <td>Alap</td>
  <td>' . $alap . '</td>
</tr></tbody></table>';


if ($_SERVER["REQUEST_METHOD"] == "POST") {



    if(isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
        
        // Create directory with product ID if it doesn't exist
        $product_dir = $target_dir . "product" . $targetid . "/";
        if (!file_exists($product_dir)) {
            mkdir($product_dir, 0777, true); // Create the directory
        }

        $extension = pathinfo($_FILES["thumbnail"]["name"]);
        $extension = $extension['extension'];
        $filename = "thumbnail." . $extension;
        $targetPath = $product_dir.$filename;
    }

    if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $targetPath)) {
        $sql = "INSERT INTO products (name, price, thumbnail, gender, brand, brand_friendly, strength, ptype, searchname, originalprice)
        VALUES ('$name', '$price', '$targetPath', '$gender', '$brand', '$brand_friendly', '$strength', '$ptype', '$searchname', '$originalprice')";
        if ($conn -> query($sql) == true)
        {
            echo "sikeres képfeltöltés - thumbnail<br>";
        }
        else {
            echo "error $sql ".$conn->error;
        }
    }
    else {
        echo "hiba a kép elhelyezésekor - thumbnail<br>";
    }



    if(isset($_FILES['image1']) && $_FILES['image1']['error'] == 0) {
        
        // Create directory with product ID if it doesn't exist
        $product_dir = $target_dir . "product" . $targetid . "/";
        if (!file_exists($product_dir)) {
            mkdir($product_dir, 0777, true); // Create the directory
        }

        $extension = pathinfo($_FILES["image1"]["name"]);
        $extension = $extension['extension'];
        $filename = "img1." . $extension;
        $targetPath1 = $product_dir.$filename;
    }

    if (move_uploaded_file($_FILES["image1"]["tmp_name"], $targetPath1)) {
        echo "sikeres képfeltöltés - image1<br>";
    }
    else {
        echo "hiba a kép elhelyezésekor - image1<br>";
    }

    if(isset($_FILES['image2']) && $_FILES['image2']['error'] == 0) {
        
        // Create directory with product ID if it doesn't exist
        $product_dir = $target_dir . "product" . $targetid . "/";
        if (!file_exists($product_dir)) {
            mkdir($product_dir, 0777, true); // Create the directory
        }

        $extension = pathinfo($_FILES["image2"]["name"]);
        $extension = $extension['extension'];
        $filename = "img2." . $extension;
        $targetPath2 = $product_dir.$filename;
    }

    if (move_uploaded_file($_FILES["image2"]["tmp_name"], $targetPath2)) {
        $sql = "INSERT INTO productdata (product_id, image1, image2, description, desc_short, flavor_table, size, stock)
        VALUES ($targetid, '$targetPath1', '$targetPath2', '$description', '$desc_short', '$flavor_table', '$size', $stock)";
        if ($conn -> query($sql) == true)
        {
            echo "sikeres képfeltöltés - image2<br>";
        }
        else {
            echo "error $sql ".$conn->error;
        }
    }
    else {
        echo "hiba a kép elhelyezésekor - image2<br>";
    }
}

$conn->close();
?>
