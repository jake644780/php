<?php
require('connect.php');
if ($_SESSION['username']){
?>

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

<?php
}else{ header('location:index.php');} 
?>