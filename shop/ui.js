
//  Script.js 
const rangevalue =  
    document.querySelector(".slider-container .price-slider"); 
const rangeInputvalue =  
    document.querySelectorAll(".range-input input"); 
  
// Set the price gap 
let priceGap = 500; 
  
// Adding event listners to price input elements 
const priceInputvalue =  
    document.querySelectorAll(".price-input input"); 
for (let i = 0; i < priceInputvalue.length; i++) { 
    priceInputvalue[i].addEventListener("input", e => { 
  
        // Parse min and max values of the range input 
        let minp = parseInt(priceInputvalue[0].value); 
        let maxp = parseInt(priceInputvalue[1].value); 
        let diff = maxp - minp 
  
        if (minp < 0) { 
            alert("A minimum ár nem lehet ennél kevesebb: 0 Ft"); 
            priceInputvalue[0].value = 0; 
            minp = 0; 
        } 
  
        // Validate the input values 
        if (maxp > 100000) { 
            alert("A maximum ár nem lehet ennél több: 100000 Ft"); 
            priceInputvalue[1].value = 100000; 
            maxp = 100000; 
        } 
  
        if (minp > maxp - priceGap) { 
            priceInputvalue[0].value = maxp - priceGap; 
            minp = maxp - priceGap; 
  
            if (minp < 0) { 
                priceInputvalue[0].value = 0; 
                minp = 0; 
            } 
        } 
  
        // Check if the price gap is met  
        // and max price is within the range 
        if (diff >= priceGap && maxp <= rangeInputvalue[1].max) { 
            if (e.target.className === "min-input") { 
                rangeInputvalue[0].value = minp; 
                let value1 = rangeInputvalue[0].max; 
                rangevalue.style.left = `${(minp / value1) * 100}%`; 
            } 
            else { 
                rangeInputvalue[1].value = maxp; 
                let value2 = rangeInputvalue[1].max; 
                rangevalue.style.right =  
                    `${100 - (maxp / value2) * 100}%`; 
            } 
        } 
    }); 
  
    // Add event listeners to range input elements 
    for (let i = 0; i < rangeInputvalue.length; i++) { 
        rangeInputvalue[i].addEventListener("input", e => { 
            let minVal =  
                parseInt(rangeInputvalue[0].value); 
            let maxVal =  
                parseInt(rangeInputvalue[1].value); 
  
            let diff = maxVal - minVal 
              
            // Check if the price gap is exceeded 
            if (diff < priceGap) { 
              
                // Check if the input is the min range input 
                if (e.target.className === "min-range") { 
                    rangeInputvalue[0].value = maxVal - priceGap; 
                } 
                else { 
                    rangeInputvalue[1].value = minVal + priceGap; 
                } 
            } 
            else { 
              
                // Update price inputs and range progress 
                priceInputvalue[0].value = minVal; 
                priceInputvalue[1].value = maxVal; 
                rangevalue.style.left = 
                    `${(minVal / rangeInputvalue[0].max) * 100}%`; 
                rangevalue.style.right = 
                    `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`; 
            } 
        }); 
    } 
}

function updateVal() {
    minVal = priceInputvalue[0].value;
    maxVal = priceInputvalue[1].value;
    rangevalue.style.left = 
        `${(minVal / rangeInputvalue[0].max) * 100}%`; 
    rangevalue.style.right = 
        `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`; 
    console.log(rangevalue.style.right);
}

document.getElementById('filterform').addEventListener('submit', filterProducts);

function submitFilterForm() {
    var select = document.getElementById('orderby_select');
    var select_fake = document.getElementById('orderby');
    select_fake.value = select.value;
    document.getElementById('filterform').submit();
}

function filterProducts() {
    var brands = ['disney', 'marvel', 'air_val']
    var minPrice = document.getElementById('min-price').value;
    var maxPrice = document.getElementById('max-price').value;
    var male = document.getElementById('input-male').checked;
    var female = document.getElementById('input-male').checked;

    var select_fake = document.getElementById('orderby');

    var selectedBrands = brands.filter(function(brand) {
        return document.getElementById(brand).checked;
    }).join(',');    


    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'products.php?minPrice=' + minPrice + '&maxPrice=' + maxPrice + male + female +selectedBrands + select_fake.value, true);


    xhr.send();
};


