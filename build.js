// 1. Zgjedhim Elementet Kryesore të DOM-it
const sizeInputs = document.querySelectorAll('input[name="madhesia"]');
const shijaSelect = document.getElementById('shija-biskotes');
const mbushjaSelect = document.getElementById('mbushja');
const mbishkrimiInput = document.getElementById('mbishkrimi');
const previewText = document.getElementById('preview-text');
const cmimiTotalSpan = document.getElementById('cmimi-total');

// 2. Çmimet BAZË për opsionet (në Euro)
// Çmimi Bazë: 10 Persona = 40.00 EUR
// Çmimi Bazë: 20 Persona = 65.00 EUR
const cmimetBaze = {
    '10': 40.00,
    '20': 65.00
};

// Çmimet SHTESË për shije dhe mbushje (shtojnë koston mbi çmimin bazë)
const cmimetShtese = {
    'shija': {
        'vanilje': 0.00,
        'çokollate': 5.00, // Çokollata e Zezë ka kosto shtesë
        'redvelvet': 7.50
    },
    'mbushja': {
        'krem-vanilje': 0.00,
        'karamel': 6.00,
        'fruta': 8.00 // Frutat kanë kosto më të lartë
    }
};

// 3. Funksioni Kryesor i Përditësimit
function updateCake() {
    // A. Përditësimi i Mbishkrimit (Teksti në tortë)
    const textValue = mbishkrimiInput.value.trim();
    // Shfaq ose tekstin e shkruar ose tekstin standard, nëse fusha është bosh
    previewText.textContent = textValue === "" ? "Gëzuar Ditëlindjen!" : textValue;

    // B. Llogaritja e Çmimit
    
    // 1. Gjej Çmimin Bazë (bazuar në madhësinë e zgjedhur)
    let cmimiBaze = 0;
    let selectedSize = '';
    sizeInputs.forEach(input => {
        if (input.checked) {
            selectedSize = input.value;
        }
    });
    cmimiBaze = cmimetBaze[selectedSize] || 0; // Përdor 0 nëse nuk gjendet asgjë

    // 2. Shto koston e Shijes
    const shijaValue = shijaSelect.value;
    const kostoShija = cmimetShtese.shija[shijaValue] || 0;

    // 3. Shto koston e Mbushjes
    const mbushjaValue = mbushjaSelect.value;
    const kostoMbushja = cmimetShtese.mbushja[mbushjaValue] || 0;

    // 4. Llogarit Çmimin Total
    let cmimiTotal = cmimiBaze + kostoShija + kostoMbushja;

    // 5. Përditëso DOM-in me çmimin e ri
    // Fiksoni çmimin në dy shifra pas presjes
    cmimiTotalSpan.textContent = `€${cmimiTotal.toFixed(2)}`;
}

// 4. Shtojmë Dëgjuesit e Ngjarjeve (Event Listeners)

// Dëgjuesit për ndryshimin e çdo opsioni
sizeInputs.forEach(input => {
    input.addEventListener('change', updateCake);
});

shijaSelect.addEventListener('change', updateCake);
mbushjaSelect.addEventListener('change', updateCake);

// Dëgjuesi për mbishkrimin (ndryshon kur shkruani)
mbishkrimiInput.addEventListener('input', updateCake);

// 5. Thirrja Fillestare
// Kjo siguron që kur faqja ngarkohet (ose bën 'refresh'), 
// torta dhe çmimi të shfaqen saktë me vlerat e paracaktuara (default)
document.addEventListener('DOMContentLoaded', updateCake);