<?php

require_once 'Database.php'; 
$db = new Database();
$pdo = $db->getConnection();

$message = ""; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $madhesia = $_POST['madhesia'];
    $shija = $_POST['shija-biskotes'];
    $mbushja = $_POST['mbushja'];
    $mbishkrimi = $_POST['mbishkrimi'];
    $cmimi = ($madhesia == "20") ? 65.00 : 45.00;

    $sql = "INSERT INTO orders (madhesia, shija_biskotes, mbushja, mbishkrimi, cmimi) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$madhesia, $shija, $mbushja, $mbishkrimi, $cmimi])) {
        $message = "Porosia u dërgua me sukses!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build Your Own - SweetCakes</title>
    <link rel="stylesheet" href="build.css">
</head>
<body>
    <section id="Cakes">
        <nav>
            <div class="logo">
                <img src="homepage/logoja.png" alt="Logo">
            </div>
            <ul>
                <li><a href="pastry.html">Home</a></li>
                <li><a href="cakes.php">Cakes</a></li>
                <li><a href="offers.php">Offers</a></li>
                <li><a href="build.php">Build your own</a></li>
            </ul>
            <a href="loginpage.html" class="shopping-cart">
                <img src="homepage/Screenshot 2025-12-15 193709.png" alt="Shporta" width="50">
            </a>
        </nav>

        <?php if($message != ""): ?>
            <div style="background: #d4edda; color: #155724; padding: 15px; text-align: center; font-weight: bold;">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <main class="cake-builder-container">
            <form action="build.php" method="POST" class="options-panel">
                <h2>1. Zgjidh Madhësinë</h2>
                <div class="option-group">
                    <input type="radio" id="madhesia10" name="madhesia" value="10" checked>
                    <label for="madhesia10">10 Persona</label>
                    <input type="radio" id="madhesia20" name="madhesia" value="20">
                    <label for="madhesia20">20 Persona</label>
                </div>

                <h2>2. Shija e Biskotës</h2>
                <select id="shija-biskotes" name="shija-biskotes">
                    <option value="vanilje">Vanilje Klasike</option>
                    <option value="çokollate">Çokollatë e Zezë</option>
                    <option value="redvelvet">Red Velvet</option>
                </select>

                <h2>3. Mbushja (Kremi)</h2>
                <select id="mbushja" name="mbushja">
                    <option value="krem-vanilje">Krem Vanilje</option>
                    <option value="karamel">Karamel i Kripur</option>
                    <option value="fruta">Fruta Pylli</option>
                </select>

                <h2>4. Mbishkrimi</h2>
                <input type="text" id="mbishkrimi" name="mbishkrimi" placeholder="Shkruaj urimin...">

                <hr>

                <div class="summary-panel">
                    <h3>Përmbledhje & Porosi</h3>
                    <p>Çmimi Total: <span id="cmimi-total">€45.00</span></p>
                    <button type="submit" class="order-button">Shto në Shportë</button>
                    <p class="data-info">Koha e nevojshme: 3 ditë pune</p>
                </div>
            </form>

            <section class="visualization-panel">
                 <h3>Pamja e Tortës Suaj</h3>
                 <div class="cake-preview">
                     <div class="cake-text" id="preview-text">Gëzuar Ditëlindjen!</div>
                 </div>
            </section>
        </main>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section about">
                <h3>SweetCakes</h3>
                <p>Cakes made with love and the finest ingredients.</p>
            </div>
            <div class="footer-section location">
                <h4>Location</h4>
                <p>Prishtina, Kosovo</p>
                <p>Rr. Bulevardi Bill Clinton</p>
            </div>
            <div class="footer-section contact">
                <h4>Contact Us</h4>
                <p>Email: info@sweetcakes.com</p>
                <p>Phone: +383 44 000 000</p>
            </div>
        </div>
        <div class="footer-bottom">
            © 2025 SweetCakes. All Rights Reserved.
                    </div>
    </footer>

    <script src="build.js"></script>
</body>
</html>