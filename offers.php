<?php
require_once 'Database.php'; 
$db = new Database();
$pdo = $db->getConnection();

$query = "SELECT * FROM offers";
$stmt = $pdo->prepare($query);
$stmt->execute();
$offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetCakes - Offers</title>
    <link rel="stylesheet" href="offers.css">
</head>
<body>
    <section id="Cakes">
        <nav>
            <div class="logo">
                <img src="offerspage/Logo.png" alt="Logo">
            </div>
            <ul>
                <li><a href="pastry.php">Home</a></li>
                <li><a href="cakes.php">Cakes</a></li>
                <li><a href="offers.php">Offers</a></li>
                <li><a href="build.php">Build your own</a></li>
            </ul>
            <a href="loginpage.html" class="shopping-cart">
                <img src="homepage/Screenshot 2025-12-15 193709.png" alt="Shporta" width="50">
            </a>
        </nav>

        <div class="menu-container">
            <header class="menu-header">
                <h1 class="main-title">
                    <span class="d-letter">O</span>UR
                    <span class="d-letter">O</span>FFERS
                </h1>
            </header>

            <main class="dessert-section">
                <?php if (count($offers) > 0): ?>
                    <?php foreach ($offers as $offer): ?>
                        <div class="menu-item item-2">
                            <div class="info-block align-left">
                                <p class="price">$<?php echo number_format($offer['cmimi'], 2); ?></p>
                                <h2 class="dessert-name"><?php echo htmlspecialchars($offer['emri']); ?></h2>
                                <p class="description"><?php echo htmlspecialchars($offer['pershkrimi']); ?></p>
                            </div>
                            <img src="offerspage/<?php echo htmlspecialchars($offer['imazhi']); ?>" alt="Dessert" class="dessert-img">
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align:center; color: white;">Aktualisht nuk ka oferta në dispozicion.</p>
                <?php endif; ?>
            </main>
        </div>
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
</body>
</html>