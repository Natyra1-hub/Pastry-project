<?php

require_once 'Database.php'; 

$db = new Database();
$pdo = $db->getConnection();


$queryCakes = "SELECT * FROM cakes LIMIT 8";
$stmtCakes = $pdo->prepare($queryCakes);
$stmtCakes->execute();
$cakes = $stmtCakes->fetchAll(PDO::FETCH_ASSOC);

$queryBday = "SELECT * FROM birthday_cakes LIMIT 8";
$stmtBday = $pdo->prepare($queryBday);
$stmtBday->execute();
$bday_cakes = $stmtBday->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetCakes - Menu</title>
    <link rel="stylesheet" href="cakes.css">
</head>
<body>
    <section id="Cakes">
        <nav>
            <div class="logo">
                <img src="photocakes/Logo.png" alt="Logo">
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

        <div class="main">
            <div class="men_text">
                <h1>Taste the<span>cake you’ve been</span><br>dreaming of</h1>
            </div>
            <div class="main_image">
                <img src="photocakes/download.png" >
            </div>
        </div>
        <p>Welcome to our world of sweetness, where every cake is created with passion and imagination...</p>
    </section>

    <div class="menu">
        <h1>Our <span>Menu</span></h1>
        <div class="menu_box">
            <?php if (count($cakes) > 0): ?>
                <?php foreach ($cakes as $cake): ?>
                    <div class="menu_card">
                        <div class="menu_image">
                            <img src="photocakes/<?php echo htmlspecialchars($cake['imazhi']); ?>" alt="Cake">
                        </div>
                        <div class="tooltip">
                            <p><?php echo htmlspecialchars($cake['pershkrimi']); ?></p>
                        </div>
                        <div class="menu_info">
                            <h2><?php echo htmlspecialchars($cake['emri']); ?></h2>
                            <h3>$<?php echo number_format($cake['cmimi'], 2); ?></h3>
                            <div class="menu_icon"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nuk u gjet asnjë tortë në menu.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="multi-carousel-section">
        <h1>We also offer birthday cakes.</h1> 
        <div class="carousel-wrapper">
            <a class="prev-multi" onclick="moveCarousel(-1)">&#10094;</a>

            <div class="carousel-viewport">
                <div class="carousel-track">
                    <?php if (count($bday_cakes) > 0): ?>
                        <?php foreach ($bday_cakes as $bday): ?>
                            <div class="carousel-card">
                                <div class="card-image">
                                    <img src="photocakes/<?php echo htmlspecialchars($bday['imazhi']); ?>" alt="Birthday Cake">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Shto foto në tabelën birthday_cakes!</p>
                    <?php endif; ?>
                </div>
            </div> 
            <a class="next-multi" onclick="moveCarousel(1)">&#10095;</a>
        </div>
    </div>

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

    <script src="cakes.js"></script>
</body>
</html>