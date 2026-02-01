<?php
session_start(); 
require_once 'Database.php'; 

$db = new Database();
$pdo = $db->getConnection();

$message = ""; 

// LOGJIKA PËR SHTIMIN
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['shto_ne_shporte'])) {
    if(!isset($_SESSION['user_id'])) {
        header("Location: loginpage.php");
        exit();
    }

    $madhesia = $_POST['madhesia'];
    $shija = $_POST['shija-biskotes'];
    $mbushja = $_POST['mbushja'];
    $mbishkrimi = htmlspecialchars($_POST['mbishkrimi']);
    $user_id = $_SESSION['user_id'];
    $cmimi = ($madhesia == "20") ? 65.00 : 45.00;
    
    // 1. KRIJO EMER DINAMIK (Që klienti ta shohë në shportë çka ka zgjedhur)
    $emri_plote = "Torta Custom ($shija, $mbushja)";

    $item = [
        'id' => 'custom_' . time(),
        'emri' => $emri_plote,
        'cmimi' => $cmimi
    ];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $_SESSION['cart'][] = $item;

    try {
        // 2. RUAJTJA NË DATABASE
        $sql = "INSERT INTO orders (user_id, emri_klientit, adresa, telefoni, totali, statusi) 
                VALUES (?, ?, 'Custom Order (Build)', 'N/A', ?, 'Pending')";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$user_id, $_SESSION['username'], $cmimi])) {
            // 3. RIDREJTIMI AUTOMATIK
            header("Location: porosite.php");
            exit();
        }
    } catch (PDOException $e) {
        $message = "Gabim: " . $e->getMessage();
    }
}

// Llogaritja e numrit bëhet këtu në fund që të jetë gjithmonë e saktë
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build Your Own - SweetCakes</title>
    <link rel="stylesheet" href="build.css">
    <style>
        /* Stili për Badge-in e shportës */
        .shopping-cart-container {
            position: relative;
            display: inline-block;
        }
        .cart-count-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 7px;
            font-size: 12px;
            font-weight: bold;
            border: 2px solid white;
        }
        .alert-error {
            background: #ff4d4d;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <section id="Cakes">
      <nav>
    <div class="logo">
        <img src="homepage/logoja.png" alt="Logo">
    </div>
    
    <ul>
        <li><a href="pastry.php">Home</a></li>
        <li><a href="cakes.php">Cakes</a></li>
        <li><a href="offers.php">Offers</a></li>
        <li><a href="build.php">Build your own</a></li>

        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"): ?>
            <li><a href="dashboard.php" style="color: #ff69b4; font-weight: bold;">Dashboard</a></li>
        <?php endif; ?>

        <?php if(isset($_SESSION['user_id'])): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="loginpage.php">Login</a></li>
        <?php endif; ?>
    </ul>

    <a href="porosite.php" class="shopping-cart-container">
        <img src="homepage/Screenshot 2025-12-15 193709.png" alt="Shporta" width="50">
        <?php if($cart_count > 0): ?>
            <span class="cart-count-badge"><?php echo $cart_count; ?></span>
        <?php endif; ?>
    </a>
</nav>

        <?php if($message != ""): ?>
            <div class="alert-error"><?php echo $message; ?></div>
        <?php endif; ?>

        <main class="cake-builder-container">
            <form action="build.php" method="POST" class="options-panel">
                <h2>1. Zgjidh Madhësinë</h2>
                <div class="option-group">
                    <input type="radio" id="madhesia10" name="madhesia" value="10" checked onchange="document.getElementById('cmimi-total').innerText='€45.00'">
                    <label for="madhesia10">10 Persona (€45)</label>
                    <input type="radio" id="madhesia20" name="madhesia" value="20" onchange="document.getElementById('cmimi-total').innerText='€65.00'">
                    <label for="madhesia20">20 Persona (€65)</label>
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
                <input type="text" id="mbishkrimi" name="mbishkrimi" placeholder="Shkruaj urimin..." onkeyup="document.getElementById('preview-text').innerText = this.value || 'Gëzuar!'">

                <hr>

                <div class="summary-panel">
                    <h3>Përmbledhje & Porosi</h3>
                    <p>Çmimi Total: <span id="cmimi-total">€45.00</span></p>
                    <button type="submit" name="shto_ne_shporte" class="order-button">Shto në Shportë</button>
                </div>
            </form>

            <section class="visualization-panel">
                 <h3>Pamja e Tortës Suaj</h3>
                 <div class="cake-preview">
                     <div class="cake-text" id="preview-text">Gëzuar!</div>
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
            © 2026 SweetCakes. All Rights Reserved.
        </div>
    </footer>

    <script src="build.js"></script>
</body>
</html>