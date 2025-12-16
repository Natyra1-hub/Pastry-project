
const sizeInputs = document.querySelectorAll('input[name="madhesia"]');
const shijaSelect = document.getElementById('shija-biskotes');
const mbushjaSelect = document.getElementById('mbushja');
const mbishkrimiInput = document.getElementById('mbishkrimi');
const previewText = document.getElementById('preview-text');
const cmimiTotalSpan = document.getElementById('cmimi-total');

const cmimetBaze = {
    '10': 40.00,
    '20': 65.00
};


const cmimetShtese = {
    'shija': {
        'vanilje': 0.00,
        'çokollate': 5.00, 
        'redvelvet': 7.50
    },
    'mbushja': {
        'krem-vanilje': 0.00,
        'karamel': 6.00,
        'fruta': 8.00 
    }
};


function updateCake() {
    const textValue = mbishkrimiInput.value.trim();
    previewText.textContent = textValue === "" ? "Gëzuar Ditëlindjen!" : textValue;

    let cmimiBaze = 0;
    let selectedSize = '';
    sizeInputs.forEach(input => {
        if (input.checked) {
            selectedSize = input.value;
        }
    });
    cmimiBaze = cmimetBaze[selectedSize] || 0;

   
    const shijaValue = shijaSelect.value;
    const kostoShija = cmimetShtese.shija[shijaValue] || 0;

  
    const mbushjaValue = mbushjaSelect.value;
    const kostoMbushja = cmimetShtese.mbushja[mbushjaValue] || 0;

   
    let cmimiTotal = cmimiBaze + kostoShija + kostoMbushja;

   
    cmimiTotalSpan.textContent = `€${cmimiTotal.toFixed(2)}`;
}

sizeInputs.forEach(input => {
    input.addEventListener('change', updateCake);
});

shijaSelect.addEventListener('change', updateCake);
mbushjaSelect.addEventListener('change', updateCake);


mbishkrimiInput.addEventListener('input', updateCake);

document.addEventListener('DOMContentLoaded', updateCake);