<?php
// get_product_details.php

$servername = "localhost";
$username = "om";
$password = "om";
$dbname = "webshop";

// Csatlakozás az adatbázishoz
$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Hiba történt az adatbázishoz való csatlakozáskor: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Adatok fogadása
    $postData = json_decode(file_get_contents("php://input"), true);

    // Adatok feldolgozása és adatbázis lekérdezés
    $products = $postData['products'];
    $result = [];

    
    foreach ($products as $productId) {
        $query = "SELECT * FROM products WHERE product_id='$productId'";
        $query_run = mysqli_query($db, $query);
        foreach($query_run as $row)
        {   
            $result[] = [
                'name' => $row['name'],
                'price' => $row['price'], 
                'image_url' => $row['thumbnail'],
                'product_id' => $row['product_id'],
                'brand' => $row['brand']
            ];
        }
    }

    // Válasz küldése
    header('Content-Type: application/json');
    echo json_encode($result);
} else {
    // Nem POST kérés esetén hiba
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}

$db->close();
?>
