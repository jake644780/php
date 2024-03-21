<?php
// Adatbázis kapcsolódás
$servername = "localhost";
$username = "om";
$password = "om";
$dbname = "webshop";

$conn = new mysqli($servername, $username, $password, $dbname);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Ellenőrzés a kapcsolódásra
if ($conn->connect_error) {
    die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
}


$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$zipcode = isset($_POST['zipcode']) ? $_POST['zipcode'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
$order_date = date("Y-m-d");
$ordered_products = isset($_POST['ordered_products']) ? $_POST['ordered_products'] : '';
$summary = isset($_POST['summary']) ? $_POST['summary'] : '';


// SQL lekérdezés az adatok beszúrásához
$sql = "INSERT INTO `orders` (`order_id`, `name`, `email`, `zipcode`, `city`, `address`, `telephone`, `comment`, `order_date`, `ordered_products`) VALUES (NULL, '$firstname $lastname', '$email', '$zipcode', '$city', '$address', '$telephone', '$comment', '$order_date', '$ordered_products');";

// Lekérdezés végrehajtása
if ($conn->query($sql) === TRUE) {
    // Az adatok sikeresen el lettek mentve az adatbázisba

    // Email küldése
    $order_id = $conn->insert_id;

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // SMTP szerver címe
    $mail->SMTPAuth = true;
    $mail->Username = '3minus.perfumes@gmail.com'; // SMTP felhasználónév
    $mail->Password = 'ymvmtjhyaerecbtr'; // SMTP jelszó
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = "UTF-8";
    $mail->Encoding = 'base64';

    $mail->setFrom('3minus.perfumes@gmail.com', '3minus');
    $mail->addAddress($email, 'Címzett');

    $mail->isHTML(true);
    $mail->Subject = 'Rendelés megerősítése';
    $mail->Body = "<!DOCTYPE html>
    <html lang='hu'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='https://fonts.googleapis.com/css2?family=Montserrat&display=swap' rel='stylesheet'>
    
        <style>
        body {
            background-image: url('src/bg.png');
    
            background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        font-family: 'Montserrat', sans-serif;
        }
    
            .cartitem {
        background-color: white;
        border-radius: 10px;
        box-shadow: 3px 0px 15px rgb(160, 160, 160);
        font-family: 'Montserrat', sans-serif;
        padding: 5px;
        width: 500px;
        margin: 20px;
        font-size: 0.9em;
        }
        
        .cartitem img{
            height: 80px;
            width: 70px;
            float: left;
            margin-right: 20px;
        }
        
        .productname {
            margin-bottom: 0px;
        }
        
        .productid {
            margin-top: 0px;
            color: #909090;
        }
        
        .productprice {
            font-size: 1.2em;
            margin-top: 10px;
        }
    
        .container-content {
            background-color: rgb(245, 245, 245);
            border-radius: 10px;
            box-shadow: 3px 0px 13px rgb(0, 0, 0);
            padding: 15px;
        }
    
        .container-logo img{
            width: 250px;
            margin: auto;
            display: block;
        }
    
        .container {
            width: 700px;
            display: block;
            margin: auto;
        }
    
        h3 {
            text-align: center;
            font-size: 1.4em;
        }
    
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='container-logo'>
                <img src='src/logo.png' alt=''>
            </div>
            <div class='container-content'>
                <h3>Kedves $firstname $lastname!</h3>
                <p>Köszönjük a vásárlást, megrendelésed megkaptuk. Amint átadjuk a futárszolgálatnak vagy átvételre kész lesz az üzletünkben, újabb e-mailben fogunk értesíteni.</p>
                <p>Rendelés azonosító: #$order_id</p>
                <div class='container-products'>
                    $summary
                </div>
                <p>Szállítási adatok: $zipcode $city, $address<br>Telefonszám: $telephone<br>Megjegyzés: $comment</p>
                <p>Köszönjük, hogy nálunk vásárolt!</p>
            </div>
        </div>
    </body>
    </html>
    
    ";

    if($mail->send()) {
        echo "Az adatok sikeresen el lettek mentve az adatbázisba, és emailt küldtünk a megadott címre.";
    } else {
        echo "Az adatok sikeresen el lettek mentve az adatbázisba, de probléma merült fel az email küldése során. Hiba: {$mail->ErrorInfo}";
    }
    echo $summary;

} else {
    echo "Hiba az adatok mentése során: " . $conn->error;
}

// Adatbázis kapcsolat bezárása
$conn->close();
?>
