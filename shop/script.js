var checkedPay = "card"
var checkedShipping = "shop"

document.getElementById('opt_cash').addEventListener('change', function() {
    // Ellenőrizzük, hogy az opt_cash kiválasztva van-e
    if (this.checked) {
      // Beállítjuk a p tage tartalmát
      document.getElementById('amountPay').innerText = "490 Ft";
      checkedPay = this.value;
      updateTotal();
    }
  });
  
document.getElementById('opt_card').addEventListener('change', function() {
    // Ellenőrizzük, hogy az opt_cash kiválasztva van-e
    if (this.checked) {
      // Beállítjuk a p tage tartalmát
      document.getElementById('amountPay').innerText = "0 Ft";
      checkedPay = this.value;
      updateTotal();
    }
});

document.getElementById('opt_paypal').addEventListener('change', function() {
    // Ellenőrizzük, hogy az opt_cash kiválasztva van-e
    if (this.checked) {
      // Beállítjuk a p tage tartalmát
      document.getElementById('amountPay').innerText = "0 Ft";
      checkedPay = this.value;
      updateTotal();
    }
});

document.getElementById('opt_shop').addEventListener('change', function() {
    // Ellenőrizzük, hogy az opt_cash kiválasztva van-e
    if (this.checked) {
      // Beállítjuk a p tage tartalmát
      document.getElementById('amountShipping').innerText = "0 Ft";
      checkedShipping = this.value;
      updateTotal();
    }
});

document.getElementById('opt_shipping').addEventListener('change', function() {
    // Ellenőrizzük, hogy az opt_cash kiválasztva van-e
    if (this.checked) {
      // Beállítjuk a p tage tartalmát
      document.getElementById('amountShipping').innerText = "1290 Ft";
      checkedShipping = this.value;
      updateTotal();
    }
});

function getShippingMethod() {
  return checkedShipping;
}

function getPayMethod() {
  return checkedPay;
}




